# Telegram 核心类

`telegramBotApiPhp\Telegram` 是唯一的根对象。用一个令牌构造它，调用任意 API 方法，然后通过便捷取值器读取更新数据。

## 构造

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

`$curlTimeout` 被限制为最小 5。对于长轮询，`getUpdates(timeout:)` 会把 cURL 超时提高到 `timeout+5`，以免套接字在轮询中途被切断。

## 更新数据

构造函数读取 `php://input`（Webhook）并将其存储为 `stdClass`。可以用 `setInputData()` 手动切换数据，并通过取值器读取类型化视图：

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

更新取值器会针对每个更新进行**缓存**（实例缓存由 `clearCache()` / `setInputData()` 清空）。

## 便捷取值器（来自 `otherTrait`）

`text()`、`caption()`、`messageID()`、`fromId()`、`chatId()`、`firstName()`、
`lastName()`、`username()`、`languageCode()`、`isPremium()`、`chatType()`、
`msgType()`、`mediaType()`、`fileId()`、`mimeType()`、`fileSize()`、`isReply()`、
`replyToMessageId()`、`pathToUrl()`。它们可用于消息、已编辑的消息、频道帖子、
回调查询以及业务消息。

`msgType()` 返回 `PRIVATE|_TEXT|_MEDIA|_FORWARD` 之一；`mediaType()` 返回
`_PHOTO|_VIDEO|_AUDIO|_VOICE|...|_TEXT`。

## 多令牌切换

```php
$bot->switchToken('new-token');   // push
$bot->restoreToken();             // pop
$bot->clearTokenStack();
$bot->getTokenStackCount();
```

## HTTP / 韧性（Telegram::bot）

`bot(method, data, isUpload)` 是底层 HTTP 调用。它会：
- 复用单个 cURL 句柄（`close()` / `__destruct` 会释放它）；
- 对网络错误、5xx 和 429 以指数退避最多重试 `maxRetries` 次；
- 对于 HTTP 429，在重试之前先遵循 `parameters.retry_after`；
- 成功时返回解码后的 `stdClass`，或在重试耗尽后返回 `['ok'=>false,'error'=>...,'http_code'=>...,'attempts'=>...]`。

`callRaw(method, data)`（公有，来自 `method` trait）调用 API 而不把结果包装成类型化对象 —— 适用于原始内省。

## 底层直接访问

- `getFileUrl($filePath)` —— 根据文件路径构建下载 URL。
- `close()` —— 显式释放 curl 句柄。

模块图谱见 [overview.md](overview.md)，完整方法列表见 [methods.md](methods.md)。
