# Основной класс Telegram

`telegramBotApiPhp\Telegram` — единственный корневой объект. Создайте его с токеном, вызовите любой метод API и читайте данные апдейта через удобные геттеры.

## Конструирование

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

`$curlTimeout` ограничивается снизу значением 5. Для long polling вызов `getUpdates(timeout:)` поднимает тайм-аут cURL до `timeout+5`, чтобы сокет не обрывался посреди поллинга.

## Данные апдейта

Конструктор читает `php://input` (вебхук) и сохраняет его как `stdClass`. Данные можно переключить вручную через `setInputData()`, типизированные представления читаются через геттеры:

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

Геттеры апдейта **кэшируются** в рамках одного апдейта (кэш экземпляра очищается через `clearCache()` / `setInputData()`).

## Удобные геттеры (из `otherTrait`)

`text()`, `caption()`, `messageID()`, `fromId()`, `chatId()`, `firstName()`,
`lastName()`, `username()`, `languageCode()`, `isPremium()`, `chatType()`,
`msgType()`, `mediaType()`, `fileId()`, `mimeType()`, `fileSize()`, `isReply()`,
`replyToMessageId()`, `pathToUrl()`. Они работают с сообщениями, отредактированными сообщениями,
постами в каналах, callback-запросами и бизнес-сообщениями.

`msgType()` возвращает одно из значений `PRIVATE|_TEXT|_MEDIA|_FORWARD`; `mediaType()` возвращает
`_PHOTO|_VIDEO|_AUDIO|_VOICE|...|_TEXT`.

## Переключение между несколькими токенами

```php
$bot->switchToken('new-token');   // push
$bot->restoreToken();             // pop
$bot->clearTokenStack();
$bot->getTokenStackCount();
```

## HTTP / устойчивость (Telegram::bot)

`bot(method, data, isUpload)` — низкоуровневый HTTP-вызов. Он:
- переиспользует единственный дескриптор cURL (`close()` / `__destruct` освобождают его);
- выполняет повторы до `maxRetries` раз с экспоненциальной задержкой при сетевых ошибках, 5xx и 429;
- при HTTP 429 сначала выжидает `parameters.retry_after`, и только затем повторяет;
- возвращает декодированный `stdClass` при успехе, либо `['ok'=>false,'error'=>...,'http_code'=>...,'attempts'=>...]` после исчерпания повторов.

`callRaw(method, data)` (публичный, из трейта `method`) вызывает API, не заворачивая результат в типизированный объект — удобно для «сырой» интроспекции.

## Прямой низкоуровневый доступ

- `getFileUrl($filePath)` — строит URL для скачивания файла по его пути.
- `close()` — явно освобождает дескриптор curl.

См. [overview.md](overview.md) для карты модулей и [methods.md](methods.md) для полного списка методов.
