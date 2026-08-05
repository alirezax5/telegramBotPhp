# Telegram core class

`telegramBotApiPhp\Telegram` is the single root object. Construct it with a token, call any API method, and read update data through convenience getters.

## Construction

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

`$curlTimeout` is clamped to a minimum of 5. For long polling, `getUpdates(timeout:)` raises the cURL timeout to `timeout+5` so the socket isn't cut mid-poll.

## Update data

The constructor reads `php://input` (webhook) and stores it as `stdClass`. Switch data manually with `setInputData()`, read typed views via getters:

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

Update getters are **cached** per update (instance cache cleared by `clearCache()` / `setInputData()`).

## Convenience getters (from `otherTrait`)

`text()`, `caption()`, `messageID()`, `fromId()`, `chatId()`, `firstName()`,
`lastName()`, `username()`, `languageCode()`, `isPremium()`, `chatType()`,
`msgType()`, `mediaType()`, `fileId()`, `mimeType()`, `fileSize()`, `isReply()`,
`replyToMessageId()`, `pathToUrl()`. These accept messages, edited messages, channel
posts, callback queries and business messages.

`msgType()` returns one of `PRIVATE|_TEXT|_MEDIA|_FORWARD`; `mediaType()` returns
`_PHOTO|_VIDEO|_AUDIO|_VOICE|...|_TEXT`.

## Multi-token switching

```php
$bot->switchToken('new-token');   // push
$bot->restoreToken();             // pop
$bot->clearTokenStack();
$bot->getTokenStackCount();
```

## HTTP / resilience (Telegram::bot)

`bot(method, data, isUpload)` is the low-level HTTP call. It:
- reuses a single cURL handle (`close()` / `__destruct` release it);
- retries up to `maxRetries` with exponential backoff for network errors, 5xx and 429;
- for HTTP 429, honours `parameters.retry_after` before retrying;
- returns a decoded `stdClass` on success, or `['ok'=>false,'error'=>...,'http_code'=>...,'attempts'=>...]` after exhausting retries.

`callRaw(method, data)` (public, from `method` trait) calls the API without wrapping the result in a typed object — useful for raw introspection.

## Direct low-level access

- `getFileUrl($filePath)` — build a download URL for a file from its path.
- `close()` — explicitly free the curl handle.

See [overview.md](overview.md) for the module map and [methods.md](methods.md) for the full method list.