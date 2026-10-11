# Classe principal Telegram

`telegramBotApiPhp\Telegram` é o único objeto raiz. Construa-o com um token, chame qualquer método da API e leia os dados do update por meio de getters de conveniência.

## Construção

```php
new Telegram(
    string $token,
    string $apiUrl = 'https://api.telegram.org',
    string $fileUrlTemplate = '{url}/file/bot{token}/{file_path}',
    int    $maxRetries = 3,
    int    $retryDelayMs = 500,
    int    $curlTimeout = 30
)
```

`$curlTimeout` é limitado a um mínimo de 5. Para long polling, `getUpdates(timeout:)` eleva o timeout do cURL para `timeout+5` para que o socket não seja cortado no meio do polling.

## Dados do update

O construtor lê `php://input` (webhook) e o armazena como `stdClass`. Troque os dados manualmente com `setInputData()` e leia as visões tipadas por meio de getters:

```php
$bot->message();            // ?Message
$bot->callbackQuery();      // ?CallbackQuery
$bot->editedMessage();      // ?Message
$bot->channelPost();        // ?Message
$bot->poll();               // ?Poll
$bot->chatMember();         // ?ChatMemberUpdated
// ... 20+ typed getters
$bot->checkUpdateExists('message');   // bool
$bot->getUpdateId();                  // int
```

Os getters de update são **cacheados** por update (o cache da instância é limpo por `clearCache()` / `setInputData()`).

## Getters de conveniência (de `otherTrait`)

`text()`, `caption()`, `messageID()`, `fromId()`, `chatId()`, `firstName()`,
`lastName()`, `username()`, `languageCode()`, `isPremium()`, `chatType()`,
`msgType()`, `mediaType()`, `fileId()`, `mimeType()`, `fileSize()`, `isReply()`,
`replyToMessageId()`, `pathToUrl()`. Elas aceitam mensagens, mensagens editadas, posts de
canal, callback queries e mensagens de business.

`msgType()` retorna um entre `PRIVATE|_TEXT|_MEDIA|_FORWARD`; `mediaType()` retorna
`_PHOTO|_VIDEO|_AUDIO|_VOICE|...|_TEXT`.

## Alternância de múltiplos tokens

```php
$bot->switchToken('new-token');   // push
$bot->restoreToken();             // pop
$bot->clearTokenStack();
$bot->getTokenStackCount();
```

## HTTP / resiliência (Telegram::bot)

`bot(method, data, isUpload)` é a chamada HTTP de baixo nível. Ela:
- reutiliza um único handle de cURL (`close()` / `__destruct` o liberam);
- tenta novamente até `maxRetries` com backoff exponencial para erros de rede, 5xx e 429;
- para HTTP 429, respeita `parameters.retry_after` antes de tentar novamente;
- retorna um `stdClass` decodificado em caso de sucesso, ou `['ok'=>false,'error'=>...,'http_code'=>...,'attempts'=>...]` após esgotar as tentativas.

`callRaw(method, data)` (público, da trait `method`) chama a API sem envolver o resultado em um objeto tipado — útil para introspecção bruta.

## Acesso direto de baixo nível

- `getFileUrl($filePath)` — constrói uma URL de download para um arquivo a partir do seu caminho.
- `close()` — libera explicitamente o handle do cURL.

Consulte [overview.md](overview.md) para o mapa de módulos e [methods.md](methods.md) para a lista completa de métodos.
