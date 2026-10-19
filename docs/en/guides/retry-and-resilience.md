# Retry & Resilience

The SDK ships a small, built-in HTTP reliability layer in `Telegram::bot()`.

## Retry policy

- **Attempts:** up to `maxRetries` retries (default **3**) after the first request.
- **Triggers to retry:** cURL/network error, `5xx` server error, and `429` (rate limit).
- **Backoff:** exponential — `retryDelayMs * 2^(attempt-1)` (default first delay 500ms → 1s → 2s).
- **429 honouring:** if the API response carries `parameters.retry_after`, the client sleeps that exact number of **seconds** before retrying (rather than the exponential guess). This avoids hammering the rate limiter.

## cURL behaviour

- A single cURL handle is created lazily and **reused** across calls (connection reuse under long polling). Free it with `close()` or on destruct.
- `CURLOPT_TIMEOUT` defaults to 30s (constructor `$curlTimeout`). For long-poll `getUpdates` with an explicit `timeout`, the socket timeout is raised to `timeout + 5` so a slow long-poll response isn't cut.
- SSL verification is ON (`CURLOPT_SSL_VERIFYPEER => true`).

## Payload normalization

`bot()` runs **every** payload through `prepareBotData()` before it hits the
wire — the raw entry point and the typed methods share one normalization
choke point:

- JSON-typed fields (`reply_markup`, `prices`, `entities`, `allowed_updates`,
  `results`, `reaction`, ...) are `json_encode`d when passed as PHP arrays.
- File fields (`photo`, `sticker`, `video`, ...) given as local paths are
  converted to `CURLFile` before encoding.
- `null` values are stripped from the final payload.

Normalization is **idempotent** — pre-encoded JSON strings and `CURLFile`
instances pass through untouched, so defensive double preparation at call
sites is harmless (and common in framework code layered on top of the SDK).

## Failure return shape

When retries are exhausted, `bot()` returns a `stdClass`:

```php
(object)[
    'ok'       => false,
    'error'    => 'curl error message' ?: 'API Error after N attempts',
    'http_code'=> 200|429|5xx|0,
    'attempts' => N,
];
```

`callRaw()` returns this raw object; typed methods wrap the `result` field if present.

## In practice

```php
$bot = new Telegram($token, maxRetries: 5, retryDelayMs: 300, curlTimeout: 60);

$res = $bot->sendMessage($chatId, 'Hi');
if (!($res->ok ?? false)) {
    // handle API error via $res->error / $res->http_code
}
```