# 重试与韧性

SDK 在 `Telegram::bot()` 中内置了一个小型 HTTP 可靠性层。

## 重试策略

- **尝试次数：** 首次请求之后最多重试 `maxRetries` 次（默认 **3**）。
- **重试触发条件：** cURL/网络错误、`5xx` 服务器错误以及 `429`（限流）。
- **退避：** 指数式 —— `retryDelayMs * 2^(attempt-1)`（默认首次延迟 500ms → 1s → 2s）。
- **遵循 429：** 如果 API 响应带有 `parameters.retry_after`，客户端会在重试之前精确休眠该数量的**秒**数（而不是按指数猜测的延迟）。这可以避免持续冲击限流器。

## cURL 行为

- 单个 cURL 句柄被惰性创建并在多次调用之间**复用**（长轮询下的连接复用）。用 `close()` 或在析构时释放它。
- `CURLOPT_TIMEOUT` 默认为 30s（构造函数的 `$curlTimeout`）。对于带显式 `timeout` 的长轮询 `getUpdates`，套接字超时会被提高到 `timeout + 5`，以便缓慢的长轮询响应不会被切断。
- SSL 验证是开启的（`CURLOPT_SSL_VERIFYPEER => true`）。

## 失败返回结构

当重试耗尽时，`bot()` 返回一个 `stdClass`：

```php
(object)[
    'ok'       => false,
    'error'    => 'curl error message' ?: 'API Error after N attempts',
    'http_code'=> 200|429|5xx|0,
    'attempts' => N,
];
```

`callRaw()` 返回这个原始对象；类型化方法会在 `result` 字段存在时将其包装。

## 实践用法

```php
$bot = new Telegram($token, maxRetries: 5, retryDelayMs: 300, curlTimeout: 60);

$res = $bot->sendMessage($chatId, 'Hi');
if (!($res->ok ?? false)) {
    // handle API error via $res->error / $res->http_code
}
```
