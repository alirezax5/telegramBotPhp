<div dir="rtl">

# راهنمای چندرباته

اجرای دو یا چند ربات داخل یک پروسه PHP — بررسی عضویت کانال با توکن ربات دوم، یا اینکه ربات ۱ اجازه داشته باشد پیام‌ها را به‌عنوان ربات ۲ بفرستد.

دو الگوی مستقل پشتیبانی می‌شود. هر دو با دو ربات واقعی به‌صورت زنده راستی‌آزمایی شده‌اند (برای جدول شواهد [CHANGELOG.md](../../../CHANGELOG.md) را ببینید).

---

## الگوی ۱ — نمونه‌های مستقل

هر شیء `Telegram` توکن، هندل cURL و کش آپدیت مخصوص به خود را دارد. هیچ چیز بین نمونه‌ها به اشتراک گذاشته نمی‌شود، بنابراین جداسازی هویت به‌صورت ساختاری تضمین شده است:

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

## الگوی ۲ — پشته توکن روی یک نمونه

یک نمونه `Telegram` می‌تواند موقتاً *تبدیل به* ربات دیگری شود، پیام بفرستد و به حالت قبل برگردد. پشته LIFO است: هر `switchToken()` توکن جاری را push می‌کند و `restoreToken()` آن را pop می‌کند.

```php
// Scenario B (owner request): bot #1 sends AS bot #2, inside bot #1's process.
$bot1->switchToken($_ENV['BOT2_TOKEN']);
$bot1->sendMessage($chatId, 'این پیام توسط نمونهٔ ربات ۱، اما با هویت ربات ۲ ارسال شد');
$bot1->restoreToken();

// The same instance is bot #1 again:
$bot1->sendMessage($chatId, 'و این یکی دوباره از ربات ۱ است');
```

توابع کمکی: `getToken()`، `switchToken(string $token)`، `restoreToken()`،
`clearTokenStack()`، `getTokenStackCount()`.

> وقتی هر دو ربات به‌طور مداوم استفاده می‌شوند الگوی ۱ را ترجیح دهید — پشته برای
> خروج‌های کوتاه و قاب‌بندی‌شده طراحی شده است. الگوی ۲ یک هندل cURL واحد نگه می‌دارد
> (سوکت‌های کمتر)، الگوی ۱ هویت‌ها را برای همیشه جدا نگه می‌دارد.

## فراخوانی‌های خام

`callRaw(string $method, array $data = [])` هر متد Bot API را اجرا می‌کند و
**پاسخ رمزگشایی‌شده کامل** را برمی‌گرداند (`stdClass` شامل `ok`، `result`، `description`،
`parameters.retry_after`) — برای متدهای به‌تازگی افزوده‌شده یا عیب‌یابی مفید است:

```php
$me    = $bot2->callRaw('getMe');          // $me->result->username
$probe = $bot2->callRaw('getChat', ['chat_id' => '@mychannel']);
```

## یکپارچگی با فریم‌ورک (TelegramBase)

[فریم‌ورک TelegramBase](https://github.com/alirezax5/telegramBase) این کتابخانه را با یک
رجیستری `BotManager` در بر می‌گیرد:

- `BOT_EXTRA_BOTS="second:<token2>,third:<token3>"` (محیطی) ربات‌های نام‌دار را هنگام بوت ثبت می‌کند؛
- پلاگین‌ها آن‌ها را از طریق `BotManager::getInstance()->get('second')` می‌گیرند؛
- ابتدا باید `has('name')` بررسی شود — `get()` با نام ناشناخته بی‌سروصدا به ربات **اصلی**
  برمی‌گردد و فراخوانی با هویت اشتباه اجرا می‌شود؛
- `docs/en/multi-bot.md` در مخزن فریم‌ورک را ببینید.

## چند ربات با یک فایل وب‌هوک (مسیریابی secret_token)

می‌توانید **هر تعداد ربات را با یک فایل وب‌هوک** سرو کنید — بدون پوشهٔ اضافه، و
توکن ربات‌ها هرگز در URL ظاهر نمی‌شود:

1. به **هر ربات یک secret تصادفی جداگانه** بدهید (`[A-Za-z0-9_-]`، ۳۲+ کاراکتر).
2. برای همهٔ ربات‌ها **همان یک URL** را ثبت کنید، هر کدام با secret خودش:
   `setWebhook?url=https://example.com/hook.php&secret_token=<secret-in-rabat>`
3. تلگرام همان secret را روی هر آپدیت در هدر `X-Telegram-Bot-Api-Secret-Token`
   برمی‌گرداند.
4. در `hook.php` هدر را بخوانید، secret را در یک رجیستری نگاه کنید
   (`secret → توکن`)، نمونهٔ `Telegram` مربوطه را بسازید (الگوی ۱) و آپدیت را
   با همان هویت پردازش کنید.

```php
// hook.php — کل روتر در چند خط
$registry = [
    'secret-A...' => $_ENV['BOT1_TOKEN'],
    'secret-B...' => $_ENV['BOT2_TOKEN'],
];
$secret = $_SERVER['HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN'] ?? '';
if (!isset($registry[$secret])) { http_response_code(403); exit; }

$bot = new Telegram($registry[$secret]);           // هویت همان ربات
$update = json_decode(file_get_contents('php://input'), true);
// ... پردازش $update با $bot ...
```

خودِ secret یک بررسی اصالت هم هست (درخواست بدون آن از تلگرام نیست — جواب
`403`). راستی‌آزمایی زنده 2026-10-11: دو ربات واقعی، یک فایل، ۷/۷ تحویل با
هویت درست هر بار.

نگهداری توکن به‌اختصار: مجموعهٔ ثابت → `.env`؛ ربات‌هایی که در زمان اجرا اضافه
می‌شوند → جدول دیتابیس با ستون توکنِ **رمزشده در حالت سکون** (با کش برای
lookup)؛ فرزندهای ساخته‌شده توسط کاربر → Managed Bots، توکن زنده از تلگرام با
`getManagedBotToken($user_id)` خوانده می‌شود و هرگز روی دیسک نوشته نمی‌شود.

## دام‌ها

- **بازگشت `get()`**: فراخوانی `get('unknown-name')` به‌جای پرتاب خطا، ربات اصلی را
  برمی‌گرداند (با لاگ هشدار) — همیشه با `has()` گارد بگذارید.
- **پشته توکن به‌ازای هر نمونه است**: عوض کردن توکن روی `$bot1` روی `$bot2` اثری ندارد.
- **بازیابی نامتوازن**: اگر `switchToken()` را بدون `restoreToken()` متناظر در مسیر
  استثنا رها کنید، نمونه هویت امان‌گرفته را نگه می‌دارد. از try/finally استفاده کنید:
  ```php
  $bot1->switchToken($t2);
  try {
      $bot1->sendMessage($chatId, 'as bot #2');
  } finally {
      $bot1->restoreToken();
  }
  ```
- **آپلود فایل داخل فیلدهای JSON**: مسیرهای محلی برای `stickers`، `media` و غیره
  به‌طور خودکار به `CURLFile` تبدیل می‌شوند (v3.3.0+) — اما فقط پیش از انکودینگ JSON،
  پس برای این پارامترها همیشه آرایه PHP بدهید (نه رشته‌های JSON از پیش انکودشده).

## راستی‌آزمایی زنده (2026-10-11)

دو ربات واقعی (`@emojiCustom_bot` به‌عنوان #1، `@instaroonxbot` به‌عنوان #2)، یک پروسه PHP:

| مرحله | نتیجه |
|---|---|
| هویت: `getMe` از طریق هر دو نمونه | ✔ دو نام کاربری |
| جداسازی: فراخوانی‌های ربات ۲ هرگز توکن ربات ۱ را لمس نکردند | ✔ |
| ارسال متقابل (الگوی ۲): ربات ۱ به‌عنوان ربات ۲ → چت کاربر | ✔ 239 ms |
| عضویت (الگوی ۱): `getChatMember` از طریق ربات ۲ | ✔ `status=member`، 13 ms |
| رفت‌وبرگشت پشته توکن روی نمونه اصلی | ✔ switch → @instaroonxbot، restore → @emojiCustom_bot |
| مجموعه کامل هارنس | ✔ 5/5، در مجموع 393 ms |
| مسیریابی secret_token: هر دو ربات → یک فایل، `/start` واقعی + تپ واقعی دکمه | ✔ ۷/۷، هر بار هویت درست |

</div>
