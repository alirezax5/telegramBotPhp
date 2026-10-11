# Guia multi-bot

Executar dois ou mais bots dentro de um único processo PHP — verificar a participação
em um canal com o token de um segundo bot, ou deixar o bot nº 1 enviar mensagens
como o bot nº 2.

Dois padrões independentes são suportados. Ambos foram verificados ao vivo com dois
bots reais (consulte [CHANGELOG.md](../../../CHANGELOG.md) para ver a tabela de evidências).

---

## Padrão 1 — Instâncias independentes

Cada objeto `Telegram` possui seu próprio token, handle de cURL e cache de updates.
Nada é compartilhado entre as instâncias, de modo que o isolamento de identidade é
garantido por construção:

```php
use telegramBotApiPhp\Telegram;

$bot1 = new Telegram($_ENV['BOT1_TOKEN']);
$bot2 = new Telegram($_ENV['BOT2_TOKEN']);

// Scenario A (owner request): membership check executed by bot #2's token,
// from inside bot #1's process.
$member = $bot2->getChatMember('@mychannel', $userId);
if (($member->result->status ?? '') === 'member') {
    // user is in the channel — checked by bot #2
}

$bot1->sendMessage($chatId, 'این پاسخ از ربات ۱ است');
$bot2->sendMessage($chatId, 'این پیام از ربات ۲ است');
```

## Padrão 2 — Pilha de tokens em uma instância

Uma instância de `Telegram` pode temporariamente *se tornar* outro bot, enviar e voltar.
A pilha é LIFO: cada `switchToken()` empurra o token atual, e `restoreToken()`
o desempilha.

```php
// Scenario B (owner request): bot #1 sends AS bot #2, inside bot #1's process.
$bot1->switchToken($_ENV['BOT2_TOKEN']);
$bot1->sendMessage($chatId, 'این پیام توسط نمونهٔ ربات ۱، اما با هویت ربات ۲ ارسال شد');
$bot1->restoreToken();

// The same instance is bot #1 again:
$bot1->sendMessage($chatId, 'و این یکی دوباره از ربات ۱ است');
```

Helpers: `getToken()`, `switchToken(string $token)`, `restoreToken()`,
`clearTokenStack()`, `getTokenStackCount()`.

> Prefira o Padrão 1 quando ambos os bots forem usados constantemente — a pilha foi
> projetada para excursões curtas e delimitadas. O Padrão 2 mantém um único handle de
> cURL (menos sockets), o Padrão 1 mantém as identidades permanentemente separadas.

## Chamadas brutas

`callRaw(string $method, array $data = [])` executa qualquer método da API de Bot e
retorna a **resposta completa decodificada** (`stdClass` com `ok`, `result`,
`description`, `parameters.retry_after`) — útil para métodos adicionados recentemente
ou para diagnósticos:

```php
$me    = $bot2->callRaw('getMe');          // $me->result->username
$probe = $bot2->callRaw('getChat', ['chat_id' => '@mychannel']);
```

## Integração com o framework (TelegramBase)

O [framework TelegramBase](https://github.com/alirezax5/telegramBase) embrulha esta
biblioteca com um registro `BotManager`:

- `BOT_EXTRA_BOTS="second:<token2>,third:<token3>"` (env) registra bots nomeados na inicialização;
- os plugins os obtêm via `BotManager::getInstance()->get('second')`;
- `has('name')` deve ser verificado primeiro — `get()` com um nome desconhecido silenciosamente
  retorna como fallback o bot **principal**, o que executaria a chamada sob a identidade errada;
- consulte `docs/en/multi-bot.md` no repositório do framework.

## Um arquivo de webhook, vários bots (roteamento secret_token)

Você pode atender **qualquer número de bots a partir de UM arquivo de webhook** — sem
pastas extras, e os tokens dos bots nunca aparecem em URLs:

1. Dê a **cada bot o seu próprio segredo aleatório** (`[A-Za-z0-9_-]`, 32+ caracteres).
2. Registre a **mesma URL** para todos os bots, cada um com o seu próprio segredo:
   `setWebhook?url=https://example.com/hook.php&secret_token=<this-bots-secret>`
3. O Telegram devolve o segredo a cada update no cabeçalho
   `X-Telegram-Bot-Api-Secret-Token`.
4. Em `hook.php`, leia o cabeçalho, procure o segredo em um registro
   (`segredo → token`), construa a instância de `Telegram` correspondente
   (Padrão 1) e processe o update sob essa identidade.

```php
// hook.php — o roteador inteiro em poucas linhas
$registry = [
    'secret-A...' => $_ENV['BOT1_TOKEN'],
    'secret-B...' => $_ENV['BOT2_TOKEN'],
];
$secret = $_SERVER['HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN'] ?? '';
if (!isset($registry[$secret])) { http_response_code(403); exit; }

$bot = new Telegram($registry[$secret]);           // identidade daquele bot
$update = json_decode(file_get_contents('php://input'), true);
// ... processe $update com $bot ...
```

O segredo também serve como verificação de autenticidade (requisições sem ele não
vêm do Telegram — responda `403`). Verificado ao vivo em 2026-10-11: dois bots
reais, um arquivo, 7/7 entregas com a identidade correta a cada vez.

Opções de armazenamento de tokens, versão curta: um conjunto fixo de bots → `.env`;
bots adicionados em tempo de execução → tabela no banco de dados com a coluna de
token **criptografada em repouso** (faça cache da busca); bots filhos criados por
usuários → Bots gerenciados (Managed Bots), token obtido ao vivo do Telegram com
`getManagedBotToken($user_id)` e nunca gravado em disco.

## Armadilhas

- **Fallback de `get()`**: chamar `get('unknown-name')` retorna o bot principal (com um
  log de aviso) em vez de lançar exceção — proteja sempre com `has()`.
- **A pilha de tokens é por instância**: trocar tokens em `$bot1` não afeta `$bot2`.
- **Restore sem par**: se você fizer `switchToken()` sem um `restoreToken()`
  correspondente em um caminho de exceção, a instância mantém a identidade emprestada. Use try/finally:
  ```php
  $bot1->switchToken($t2);
  try {
      $bot1->sendMessage($chatId, 'as bot #2');
  } finally {
      $bot1->restoreToken();
  }
  ```
- **Uploads de arquivo dentro de campos JSON**: caminhos locais para `stickers`,
  `media`, etc. são convertidos em `CURLFile` automaticamente (v3.3.0+) — mas somente
  antes da codificação JSON, então sempre passe arrays PHP (não strings JSON
  pré-codificadas) para esses parâmetros.

## Verificação ao vivo (2026-10-11)

Dois bots reais (`@emojiCustom_bot` como nº 1, `@instaroonxbot` como nº 2), um processo PHP:

| Etapa | Resultado |
|---|---|
| Identidade: `getMe` via ambas as instâncias | ✔ dois usernames |
| Isolamento: chamadas do bot nº 2 nunca tocaram o token do bot nº 1 | ✔ |
| Envio cruzado (Padrão 2): bot nº 1 envia como bot nº 2 → chat do usuário | ✔ 239 ms |
| Participação (Padrão 1): `getChatMember` via bot nº 2 | ✔ `status=member`, 13 ms |
| Ida e volta da pilha de tokens na instância principal | ✔ switch → @instaroonxbot, restore → @emojiCustom_bot |
| Suíte completa de harness | ✔ 5/5, 393 ms no total |
| Roteamento de webhook por secret_token: ambos os bots → UM arquivo, `/start` real + toques reais em botões | ✔ 7/7, identidade correta a cada vez |
