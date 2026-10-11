# Webhook 与长轮询

SDK 支持两种投递模式 —— 由你在应用层选择。

## Webhook（需要 HTTPS）

```php
$bot = new Telegram($token);
$update = $bot->getInputData();      // decodes php://input

if ($bot->isMessage()) {
    $bot->sendMessage($bot->chatId(), $bot->text());
}
```

- **优点：** 实时、无轮询负载、不需要保持连接打开。
- **缺点：** 需要一个公网 HTTPS 端点；回调会被 Telegram 记录日志。

### 设置

```php
$bot->setWebhook('https://example.com/hook');
$bot->getWebhookInfo();
$bot->deleteWebhook();
```

> 注意：现代格式允许通过 `$options` 数组设置 `secret_token`、`max_connections`、`allowed_updates`。

## 长轮询（无需公网服务器）

```php
$bot = new Telegram($token);
$offset = 0;

while (true) {
    $updates = $bot->getUpdates($offset, 100, 50);   // offset, limit, longpoll timeout(s)
    foreach ($updates->result as $u) {
        $offset = max($offset, $u->update_id + 1);
        $bot->setInputData($u);
        // ...handle
    }
    usleep(200_000);   // 0.2s
}
```

- **优点：** 可在 NAT 后工作、无需 TLS、简单。
- **缺点：** 保持一个套接字打开；每次轮询都是一次网络往返。

**长轮询超时说明：** SDK 默认的 cURL 超时是 30s，但对于 `getUpdates`，会使用传给 Telegram 的超时值，并把 cURL 超时提高到 `timeout + 5`，以免 HTTP 请求在 Telegram 应答之前被切断。

### 生命周期 / 单实例

每个机器人只运行恰好一个轮询进程。两个共享 `getUpdates` 偏移量的进程会悄悄地互相吞掉更新（参见*静默机器人*调试）。请使用进程管理器（systemd / supervisor）来保持它存活，而不要运行多个并发进程。

## 如何选择

- 面向公众的公开产品（Telegram webhook）→ **Webhook。
- NAT 后的本地/开发环境 → **轮询。
- 无法保持进程常开的共享主机 → 用 cron 触发脚本做轮询对低频场景没问题，但对于 Telegram 的消息量，更推荐常驻进程。
