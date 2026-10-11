# telegramBotPhp

[English](README.md) · [فارسی](README.fa.md) · [中文](README.zh.md) · [Русский](README.ru.md) · [Français](README.fr.md) · **Português** · [العربية](README.ar.md)

Wrapper PHP 8.1+ leve para a **API de Bot do Telegram** — zero dependências de runtime, cobertura completa de todos os métodos da API atuais (186 métodos de bot) e de todos os tipos de resposta/entidade (199 tipos).

Versão atual: **3.3.0** — consulte o [CHANGELOG.md](CHANGELOG.md) (corrige um `getChatMember()` quebrado na 3.2.1, completa a serialização JSON de parâmetros aninhados, remove nulls, corrige um vazamento de timeout do cURL; fluxos multi-bot verificados ao vivo com dois bots reais).

## Requisitos

- PHP >= 8.1
- Extensão cURL (`ext-curl`)
- Extensão JSON (`ext-json`)
- Composer

## Instalação

```bash
composer require alirezax5/telegram-bot-php
```

## Início Rápido

```php
require 'vendor/autoload.php';

use telegramBotApiPhp\Telegram;

// Long polling
$bot = new Telegram($_ENV['TELEGRAM_BOT_TOKEN']);

$updates = $bot->getUpdates(0, 100, 50);       // offset, limit, long-poll timeout (s)
foreach ($updates->result as $u) {
    $bot->setInputData($u);
    $chatId = $bot->chatId();
    $text   = $bot->text();

    if ($text === '/start') {
        $bot->sendMessage($chatId, 'Welcome!');
    }
}

// Webhook mode
$update = $bot->getInputData();                   // decodes php://input
if ($bot->isMessage()) {
    $bot->sendMessage($chatId, $bot->text());
}
```

## Multi-bot (dois bots em um processo)

```php
// Pattern 1 — independent instances (e.g. membership check via bot #2)
$bot2 = new Telegram($_ENV['BOT2_TOKEN']);
$member = $bot2->getChatMember('@mychannel', $userId);
$status = $member->result->status ?? 'left';      // member | administrator | creator | left | kicked

// Pattern 2 — token stack: bot #1 sends AS bot #2
$bot->switchToken($_ENV['BOT2_TOKEN']);
$bot->sendMessage($chatId, 'Sent as bot #2, from the bot #1 process');
$bot->restoreToken();

// Raw API access (full stdClass response)
$me = $bot->callRaw('getMe');
```

Guia completo: [docs/guides/multi-bot.md](docs/pt/guides/multi-bot.md).

## Arquitetura

```
src/
├── Telegram.php          # Core class — HTTP client, update parser, token stack, caching, retry
├── Traits/
│   ├── Updates.php            # polling + webhook methods (getUpdates, setWebhook, getMe, ...)
│   ├── Messages.php          # 45 messaging methods (send*, edit*, ephemeral, rich)
│   ├── ChatAdministration.php# 51 chat/admin/forum methods
│   ├── Stickers.php          # 16 sticker-set methods
│   ├── PaymentsAndGames.php  # 11 payments/stars/games methods
│   ├── Business.php          # 36 business/managed-bot/story/inline/user-verify methods
│   ├── BotSettings.php       # 20 bot-profile/commands/menu methods
│   ├── isUpdates.php         # Boolean checkers for update types (23)
│   ├── isChatTypes.php       # Boolean checkers for chat types
│   ├── isMedia.php           # Boolean checkers for media types
│   └── otherTrait.php        # Convenience getters (messageID, text, chatId, mediaType, ...)
└── Types/                    # 199 typed response wrappers (BaseType subclass)
```

`Telegram` incorpora todas as traits de domínio via a trait agregadora `method`.
Todos os métodos da API retornam um objeto tipado `returned*` (resposta) construído por `BaseType::create()`.

## Licença

MIT

## Documentação
- [architecture/overview.md](docs/pt/architecture/overview.md) — arquitetura completa
- [architecture/folder-structure.md](docs/pt/architecture/folder-structure.md)
- [architecture/methods.md](docs/pt/architecture/methods.md) — os 186 métodos agrupados por trait
- [architecture/telegram-class.md](docs/pt/architecture/telegram-class.md) — referência da classe principal
- [architecture/type-system.md](docs/pt/architecture/type-system.md) — sistema de tipos & returned*
- [guides/webhook-vs-polling.md](docs/pt/guides/webhook-vs-polling.md)
- [guides/retry-and-resilience.md](docs/pt/guides/retry-and-resilience.md) — estratégia de retry
- [guides/multi-bot.md](docs/pt/guides/multi-bot.md) — dois bots em um processo (pilha de tokens, chamadas brutas)
- [CHANGELOG.md](CHANGELOG.md) — histórico de versões
- [README.fa.md](README.fa.md) — مستندات فارسی (RTL)
