# راهنما — اعتبارسنجی `initData` مینی‌اپ

مینی‌اپ‌های تلگرام صفحات وبی هستند که داخل تلگرام باز می‌شوند. فرانت‌اند `window.Telegram.WebApp.initData` را دریافت می‌کند — یک query string که **تلگرام با توکن ربات شما امضا کرده است**. این تنها اثبات قابل‌اعتماد از *هویت کاربر* در اپ است. این SDK یک اعتبارسنج کوچک با الگوریتم رسمی HMAC-SHA256 عرضه می‌کند:

```php
use telegramBotApiPhp\WebApp\InitData;
```

> **هرگز به `initDataUnsafe` اعتماد نکنید** — همان فیلدها، بدون امضا. فقط `initData` امضاشده را می‌توان در برابر توکن ربات راستی‌آزمایی کرد. ترافیک مینی‌اپ از وب‌هوک **عبور نمی‌کند**: مرورگر کاربر مستقیماً دامنهٔ HTTPS شما را صدا می‌زند؛ بنابراین اعتبارسنج PHP خالص است و هیچ وابستگی به API ربات ندارد.

## اعتبارسنجی در endpoint شما

```php
use telegramBotApiPhp\WebApp\InitData;

// پذیرش POST فرم یا بدنهٔ JSON
$raw = $_POST['initData'] ?? null;
if (!is_string($raw) || $raw === '') {
    $json = json_decode((string) file_get_contents('php://input'), true);
    $raw  = is_array($json) ? (string) ($json['initData'] ?? '') : '';
}

$res = InitData::validate((string) $raw, BOT_TOKEN, ['max_age' => 3600]);

if (!$res['ok']) {
    http_response_code(401);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => false, 'error' => $res['error']], JSON_UNESCAPED_UNICODE);
    exit;
}

$user       = $res['user'];        // ['id' => 555000111, 'first_name' => 'علی', ...]
$startParam = $res['start_param']; // بارِ لینک عمیق از ?startapp=ref_7
$authDate   = $res['auth_date'];
```

## API

| متد | امضا | خروجی |
|---|---|---|
| `validate()` | `validate(string $initData, string $botToken, array $options = [])` | آرایهٔ کامل نتیجه |
| `valid()` | همان آرگومان‌ها | `bool` |
| `user()` | همان آرگومان‌ها | `?array` — کاربر مینی‌اپ یا `null` |
| `build()` | `build(array $fields, string $botToken)` | رشتهٔ initData **امضاشدهٔ** درست — تست، فیکسچر و تست با curl |

**نتیجهٔ موفق:** `ok`، `user` (آرایهٔ دیکودشده یا `null`)، `auth_date`، `start_param`، `fields` (همهٔ فیلدها بدون hash)، `hash`.

**نتیجهٔ ناموفق:** `ok: false` + `error`: `empty_init_data` · `bot_token_missing` · `malformed_init_data` · `hash_missing` · `bad_signature` · `auth_date_missing` · `auth_date_expired`.

**آپشن‌ها:** `max_age` — بیشینهٔ عمر پذیرفتهٔ `auth_date` به ثانیه؛ پیش‌فرض `86400`، `0` بررسی را خاموش می‌کند.

## بازکردن مینی‌اپ

- دکمهٔ کیبورد ریپلای: `sendMessage($chatId, 'فروشگاه', ['reply_markup' => ['keyboard' => [[['text' => 'بازکردن فروشگاه', 'web_app' => ['url' => 'https://your.domain/app']]]]]])`.
- یا تنظیم Menu Button ربات در BotFather (`/setmenubutton`).
- لینک عمیق: `https://t.me/yourbot?startapp=ref_7` → به‌صورت `start_param` می‌رسد.

## تست محلی

```php
// fixtures/init.php
echo InitData::build(['user' => ['id' => 555000111, 'first_name' => 'علی'], 'start_param' => 'ref_7'], BOT_TOKEN);
```

`curl --data-urlencode "initData@/tmp/init.txt" https://your.domain/app/api.php` — endpoint یک هویت کاملاً معتبر و تازه‌امضا می‌بیند.

> `build()` فقط برای توسعه و تست است.

## چک‌لیست امنیتی

- اعتبارسنجی سمت سرور روی **هر** درخواست مهم — امضا «کاربر» را ثابت می‌کند، نه منطق کسب‌وکار شما.
- `max_age` را کوتاه نگه دارید (برای عملیات حساس `3600` یا کمتر).
- درون کلاس از `hash_equals()` (زمان-ثابت) استفاده می‌شود؛ هرگز hash را با `===` مقایسه نکنید.
- `initData` و توکن‌های ربات را لاگ نکنید.
- فیلد اضافهٔ `signature` (Ed25519) برای اعتبارسنجی مینی‌اپ‌های **شخص ثالث** است؛ برای ربات خودتان بررسی HMAC `hash` طرح رسمی و کافی است.

## مرجع الگوریتم

1. `initData` را به‌صورت query string پارس کنید؛ `hash` را حذف کنید.
2. Data-check-string: فیلدهای باقی‌مانده به‌شکل `key=value`، مرتب الفبایی بر اساس کلید، چسبیده با `\n` (0x0A).
3. `secret_key = HMAC_SHA256(key="WebAppData", message=BOT_TOKEN)`
4. `computed   = HMAC_SHA256(key=secret_key, message=data_check_string)` — hex.
5. معتبر است اگر `computed == hash` (زمان-ثابت) و `auth_date` داخل `max_age` باشد.

مرتبط: کاربران telegramBase همان اعتبارسنج را با تشخیص خودکار توکن به‌شکل `alirezax5\TelegramBase\App\MiniApp\InitData` دارند — `docs/en/mini-apps.md` فریم‌ورک را ببینید.
