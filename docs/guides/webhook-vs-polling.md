# Webhook vs Long Polling

The SDK supports both delivery modes — you choose at the app level.

## Webhook (HTTPS required)

```php
$bot = new Telegram($token);
$update = $bot->getInputData();      // decodes php://input

if ($bot->isMessage()) {
    $bot->sendMessage($bot->chatId(), $bot->text());
}
```

- **Pros:** real-time, no polling load, no connection held open.
- **Cons:** requires a public HTTPS endpoint; callbacks logged by Telegram.

### Setup

```php
$bot->setWebhook('https://example.com/hook');
$bot->getWebhookInfo();
$bot->deleteWebhook();
```

> Note: the modern format allows `secret_token`, `max_connections`, `allowed_updates` via the `$options` array.

## Long polling (no public server needed)

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

- **Pros:** works behind NAT, no TLS needed, simple.
- **Cons:** holds a socket open; each poll is a network round-trip.

**Long-poll timeout note:** the SDK's default cURL timeout is 30s, but for `getUpdates` the timeout given to Telegram is used and the cURL timeout is raised to `timeout + 5` so the HTTP request isn't cut before Telegram replies.

### Lifetime / single-instance

Run exactly one polling process per bot. Two processes sharing `getUpdates` offset can silently consume updates from each other (see *silent bot* debugging). Use a process manager (systemd / supervisor) to keep it alive, not multiple concurrent processes.

## Choosing

- Public public-facing products (Telegram webhook) → **webhook.
- Local/dev behind NAT → **polling.
- Shared host that can't hold a process open → polling with a cron-triggered script is fine for low-frequency, but for a Telegram volume a persistent process is preferred.