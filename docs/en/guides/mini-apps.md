# Guide — Mini App `initData` validation

Telegram **Mini Apps** are web pages opened inside Telegram. The frontend receives `window.Telegram.WebApp.initData` — a query string **signed by Telegram** with your bot token. It is the only trustworthy proof of *which user* is using the app. This SDK ships a small validator that implements the official HMAC-SHA256 scheme:

```php
use telegramBotApiPhp\WebApp\InitData;
```

> **Never trust `initDataUnsafe`** — same fields, zero signature. Only the signed `initData` can be verified against the bot token. Mini App traffic does **not** go through the webhook: the user's browser calls your HTTPS domain directly, so the validator is pure PHP with no bot-API dependency.

## Validate in your endpoint

```php
use telegramBotApiPhp\WebApp\InitData;

// Accept form POST or a JSON body.
$raw = $_POST['initData'] ?? null;
if (!is_string($raw) || $raw === '') {
    $json = json_decode((string) file_get_contents('php://input'), true);
    $raw  = is_array($json) ? (string) ($json['initData'] ?? '') : '';
}

$res = InitData::validate((string) $raw, BOT_TOKEN, ['max_age' => 3600]);

if (!$res['ok']) {
    http_response_code(401);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => false, 'error' => $res['error']]);
    exit;
}

$user       = $res['user'];        // ['id' => 555000111, 'first_name' => 'Ali', ...]
$startParam = $res['start_param']; // deep-link payload from ?startapp=ref_7
$authDate   = $res['auth_date'];
```

## API

| Method | Signature | Returns |
|---|---|---|
| `validate()` | `validate(string $initData, string $botToken, array $options = [])` | Full result array |
| `valid()` | same args | `bool` |
| `user()` | same args | `?array` — the Mini App user or `null` |
| `build()` | `build(array $fields, string $botToken)` | A correctly **signed** initData string — tests, fixtures, local curl-ing |

**Success result:** `ok`, `user` (decoded array or `null`), `auth_date`, `start_param`, `fields` (all fields without the hash), `hash`.

**Failure result:** `ok: false` + `error`: `empty_init_data` · `bot_token_missing` · `malformed_init_data` · `hash_missing` · `bad_signature` · `auth_date_missing` · `auth_date_expired`.

**Options:** `max_age` — max accepted age of `auth_date` in seconds; default `86400`, `0` disables the check.

## Opening the Mini App

- Reply-keyboard button: `sendMessage($chatId, 'Shop', ['reply_markup' => ['keyboard' => [[['text' => 'Open Shop', 'web_app' => ['url' => 'https://your.domain/app']]]]]])`.
- Or set the bot's Menu Button in BotFather (`/setmenubutton`).
- Deep links: `https://t.me/yourbot?startapp=ref_7` → arrives as `start_param`.

## Local testing

```php
// fixtures/init.php
echo InitData::build(['user' => ['id' => 555000111, 'first_name' => 'Ali'], 'start_param' => 'ref_7'], BOT_TOKEN);
```

`curl --data-urlencode "initData@/tmp/init.txt" https://your.domain/app/api.php` — the endpoint sees a perfectly valid, freshly signed identity.

> `build()` is for development and tests only.

## Security checklist

- Validate server-side on **every** privileged request — the signature proves the user, not your business logic.
- Keep `max_age` tight (`3600` or less for sensitive operations).
- `hash_equals()` is used internally (constant-time); never compare hashes with `===`.
- Don't log `initData` or bot tokens.
- The additional `signature` field (Ed25519) is for validating **third-party** Mini Apps; for your own bot the HMAC `hash` check is the official and sufficient scheme.

## Algorithm reference

1. Parse `initData` as a query string; remove `hash`.
2. Data-check-string: remaining fields as `key=value`, sorted alphabetically by key, joined with `\n` (0x0A).
3. `secret_key = HMAC_SHA256(key="WebAppData", message=BOT_TOKEN)`
4. `computed   = HMAC_SHA256(key=secret_key, message=data_check_string)` — hex.
5. Valid iff `computed == hash` (constant-time) and `auth_date` within `max_age`.

Related: telegramBase users get the same validator with token auto-detection as `alirezax5\TelegramBase\App\MiniApp\InitData` — see the framework's `docs/en/mini-apps.md`.
