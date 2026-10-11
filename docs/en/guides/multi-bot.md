# Multi-bot guide

Running two or more bots inside one PHP process — checking channel membership with a
second bot's token, or letting bot #1 send messages as bot #2.

Two independent patterns are supported. Both were verified live with two real bots
(see [CHANGELOG.md](../../../CHANGELOG.md) for the evidence table).

---

## Pattern 1 — Independent instances

Each `Telegram` object owns its own token, cURL handle and update cache. Nothing is
shared between instances, so identity isolation is guaranteed by construction:

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

## Pattern 2 — Token stack on one instance

One `Telegram` instance can temporarily *become* another bot, send, and switch back.
The stack is LIFO: every `switchToken()` pushes the current token, `restoreToken()`
pops it.

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

> Prefer Pattern 1 when both bots are used constantly — the stack is designed for
> short, bracketed excursions. Pattern 2 keeps a single cURL handle (fewer sockets),
> Pattern 1 keeps identities permanently separated.

## Raw calls

`callRaw(string $method, array $data = [])` performs any Bot API method and returns
the **full decoded response** (`stdClass` with `ok`, `result`, `description`,
`parameters.retry_after`) — useful for methods added recently or diagnostics:

```php
$me    = $bot2->callRaw('getMe');          // $me->result->username
$probe = $bot2->callRaw('getChat', ['chat_id' => '@mychannel']);
```

## Framework integration (TelegramBase)

The [TelegramBase framework](https://github.com/alirezax5/telegramBase) wraps this
library with a `BotManager` registry:

- `BOT_EXTRA_BOTS="second:<token2>,third:<token3>"` (env) registers named bots at boot;
- plugins fetch them via `BotManager::getInstance()->get('second')`;
- `has('name')` must be checked first — `get()` of an unknown name silently falls back
  to the **main** bot, which would execute the call under the wrong identity;
- see `docs/en/multi-bot.md` in the framework repository.

## One webhook file, many bots (secret_token routing)

You can serve **any number of bots from ONE webhook file** — no extra folders, and
bot tokens never appear in URLs:

1. Give **every bot its own random secret** (`[A-Za-z0-9_-]`, 32+ chars).
2. Register the **same URL** for every bot, each with its own secret:
   `setWebhook?url=https://example.com/hook.php&secret_token=<this-bots-secret>`
3. Telegram echoes the secret back on every update in the header
   `X-Telegram-Bot-Api-Secret-Token`.
4. In `hook.php`, read the header, look the secret up in a registry
   (`secret → token`), then build the matching `Telegram` instance
   (Pattern 1) and process the update under that identity.

```php
// hook.php — the whole router in a few lines
$registry = [
    'secret-A...' => $_ENV['BOT1_TOKEN'],
    'secret-B...' => $_ENV['BOT2_TOKEN'],
];
$secret = $_SERVER['HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN'] ?? '';
if (!isset($registry[$secret])) { http_response_code(403); exit; }

$bot = new Telegram($registry[$secret]);           // that bot's identity
$update = json_decode(file_get_contents('php://input'), true);
// ... handle $update with $bot ...
```

The secret doubles as an authenticity check (requests without it are not from
Telegram — answer `403`). Verified live 2026-10-11: two real bots, one file,
7/7 deliveries with the correct identity every time.

Token storage options, short version: a fixed set of bots → `.env`; bots added
at runtime → DB table with the token column **encrypted at rest** (cache the
lookup); user-created children → Managed Bots, token fetched live from Telegram
with `getManagedBotToken($user_id)` and never written to disk.

## Pitfalls

- **`get()` fallback**: calling `get('unknown-name')` returns the main bot (with a
  warning log) instead of throwing — always guard with `has()`.
- **Token stack is per-instance**: switching tokens on `$bot1` does not affect `$bot2`.
- **Unbalanced restore**: if you `switchToken()` without a matching `restoreToken()`
  on an exception path, the instance keeps the borrowed identity. Use try/finally:
  ```php
  $bot1->switchToken($t2);
  try {
      $bot1->sendMessage($chatId, 'as bot #2');
  } finally {
      $bot1->restoreToken();
  }
  ```
- **File uploads inside JSON fields**: local paths for `stickers`, `media`, etc. are
  converted to `CURLFile` automatically (v3.3.0+) — but only before JSON encoding, so
  always pass PHP arrays (not pre-encoded JSON strings) for those parameters.

## Live verification (2026-10-11)

Two real bots (`@emojiCustom_bot` as #1, `@instaroonxbot` as #2), one PHP process:

| Step | Result |
|---|---|
| Identity: `getMe` via both instances | ✔ two usernames |
| Isolation: bot #2 calls never touched bot #1's token | ✔ |
| Cross-send (Pattern 2): bot #1 sends as bot #2 → user chat | ✔ 239 ms |
| Membership (Pattern 1): `getChatMember` via bot #2 | ✔ `status=member`, 13 ms |
| Token stack round-trip on the main instance | ✔ switch → @instaroonxbot, restore → @emojiCustom_bot |
| Full harness suite | ✔ 5/5, 393 ms total |
| secret_token webhook routing: both bots → ONE file, real `/start` + real button taps | ✔ 7/7, correct identity every time |
