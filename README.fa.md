<div dir="rtl">

# telegramBotPhp — مستندات فارسی

کتابخانه‌ای سبک برای **Telegram Bot API** روی PHP 8.1+ — بدون هیچ وابستگی زمان اجرا، با پوشش کامل تمام متدهای فعلی API (۱۸۶ متد) و تمام انواع پاسخ/موجودیت (۱۹۹ کلاس تایپ‌شده).

نسخه فعلی: **3.3.0** — تاریخچه کامل در [CHANGELOG.md](CHANGELOG.md).

> این سند معادل فارسیِ [README.md](README.md) است و در صورت تفاوت، نسخه انگلیسی ملاک است.

## نیازمندی‌ها

- PHP نسخه 8.1 به بالا
- افزونه cURL (`ext-curl`)
- افزونه JSON (`ext-json`)
- Composer

## نصب

```bash
composer require alirezax5/telegram-bot-php
```

## شروع سریع

```php
require 'vendor/autoload.php';

use telegramBotApiPhp\Telegram;

// حالت Long polling
$bot = new Telegram($_ENV['TELEGRAM_BOT_TOKEN']);

$updates = $bot->getUpdates(0, 100, 50);       // آفست، سقف تعداد، مهلت long-poll (ثانیه)
foreach ($updates->result as $u) {
    $bot->setInputData($u);
    $chatId = $bot->chatId();
    $text   = $bot->text();

    if ($text === '/start') {
        $bot->sendMessage($chatId, 'خوش آمدید!');
    }
}

// حالت Webhook
$update = $bot->getInputData();                   // رمزگشایی php://input
if ($bot->isMessage()) {
    $bot->sendMessage($chatId, $bot->text());
}
```

## چندرباته (دو ربات در یک پروسه)

دو الگو پشتیبانی می‌شود؛ هر دو با دو ربات واقعی به‌صورت زنده تست شده‌اند:

```php
// الگوی ۱ — نمونه‌های مستقل (مثال: چک عضویت کاربر در کانال با توکن ربات دوم)
$bot2 = new Telegram($_ENV['BOT2_TOKEN']);
$member = $bot2->getChatMember('@mychannel', $userId);
$status = $member->result->status ?? 'left';      // member | administrator | creator | left | kicked

// الگوی ۲ — توکن‌استک: ربات ۱ «به‌عنوان» ربات ۲ پیام می‌فرستد
$bot->switchToken($_ENV['BOT2_TOKEN']);
$bot->sendMessage($chatId, 'این پیام با هویت ربات ۲، اما داخل پروسه ربات ۱ ارسال شد');
$bot->restoreToken();

// فراخوانی خام API (پاسخ کامل stdClass)
$me = $bot->callRaw('getMe');
```

راهنمای کامل: [docs/guides/multi-bot.md](docs/guides/multi-bot.md).

## اعتبارسنجی `initData` مینی‌اپ

فرانت‌اند مینی‌اپ از تلگرام یک رشتهٔ هویتی **امضاشده** می‌گیرد (`Telegram.WebApp.initData`). قبل از سرو هر دادهٔ کاربر، آن را سمت سرور راستی‌آزمایی کنید — `telegramBotApiPhp\WebApp\InitData` الگوریتم رسمی HMAC-SHA256 را با مقایسهٔ زمان-ثابت پیاده می‌کند:

```php
use telegramBotApiPhp\WebApp\InitData;

$res = InitData::validate($_POST['initData'] ?? '', $botToken, ['max_age' => 3600]);
if (!$res['ok']) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => $res['error']], JSON_UNESCAPED_UNICODE);   // bad_signature، auth_date_expired، ...
    exit;
}

$me         = $res['user'];         // ['id' => 555000111, 'first_name' => 'علی', ...]
$startParam = $res['start_param'];  // بار لینک عمیق از ?startapp=...
```

هلپرها: `valid()`، `user()` و `build()` — مولد فیکسچر امضاشده (فقط توسعه) برای تست endpointها قبل از ساختن فرانت‌اند. راهنمای کامل: [docs/guides/mini-apps.md](docs/guides/mini-apps.md).

## نکته‌های مهم نسخه 3.3.0

- `getChatMember()` در نسخه 3.2.1 به دلیل فراموشی یک `use` کاملاً شکسته بود — در این نسخه رفع و به‌صورت زنده تست شده است.
- همه پارامترهای تودرتو (مانند `message_ids`، `allowed_updates`، `entities`، `reply_markup`، `results` و …) به‌صورت خودکار JSON می‌شوند؛ آرایه خام PHP دیگر خطای «can't parse» نمی‌دهد.
- مقادیر `null` از payload حذف می‌شوند و فایل‌های محلی پیش از انکودینگ به `CURLFile` تبدیل می‌شوند (آپلود استیکر/مدیا با مسیر محلی سالم است).
- هر فراخوانی، `CURLOPT_TIMEOUT` را ریست می‌کند؛ مهلت long-poll به فراخوانی‌های بعدی نشت نمی‌کند.

## معماری

```
src/
├── Telegram.php          # کلاس اصلی — کلاینت HTTP، پارسر آپدیت، توکن‌استک، کش، retry
├── Traits/
│   ├── Updates.php            # متدهای polling و webhook (getUpdates، setWebhook، getMe و ...)
│   ├── Messages.php           # ۴۵ متد پیام‌رسانی (send*، edit*، ephemeral، rich)
│   ├── ChatAdministration.php # ۵۱ متد مدیریت چت/ادمین/فروم
│   ├── Stickers.php           # ۱۶ متد استیکر
│   ├── PaymentsAndGames.php   # ۱۱ متد پرداخت/ستاره/بازی
│   ├── Business.php           # ۳۶ متد business/استوری/inline
│   ├── BotSettings.php        # ۲۰ متد تنظیمات ربات
│   ├── isUpdates.php          # چکرهای بولی نوع آپدیت (۲۳)
│   ├── isChatTypes.php        # چکرهای بولی نوع چت
│   ├── isMedia.php            # چکرهای بولی نوع مدیا
│   └── otherTrait.php         # گترهای کمکی (messageID، text، chatId، mediaType و ...)
└── Types/                    # ۱۹۹ کلاس تایپ‌شده پاسخ (زیرکلاس BaseType)
```

کلاس `Telegram` همه traitهای دامنه‌ای را از طریق trait تجمیع‌گر `method` به کار می‌گیرد.
خروجی همه متدهای API، آبجکت تایپ‌شده `returned*` است که با `BaseType::create()` ساخته می‌شود.
اعتبارسنجی هویت مینی‌اپ در `src/WebApp/InitData.php` است (مستقل، بدون وابستگی به API ربات).

## مجوز

MIT

## مستندات

- [architecture/overview.md](docs/architecture/overview.md) — معماری کامل
- [architecture/methods.md](docs/architecture/methods.md) — فهرست ۱۸۶ متد به تفکیک trait
- [architecture/telegram-class.md](docs/architecture/telegram-class.md) — مرجع کلاس اصلی
- [architecture/type-system.md](docs/architecture/type-system.md) — سیستم تایپ و returned*
- [guides/webhook-vs-polling.md](docs/guides/webhook-vs-polling.md) — انتخاب حالت دریافت آپدیت
- [guides/retry-and-resilience.md](docs/guides/retry-and-resilience.md) — استراتژی retry
- [guides/multi-bot.md](docs/guides/multi-bot.md) — دو ربات در یک پروسه (توکن‌استک، فراخوانی خام)
- [guides/mini-apps.md](docs/guides/mini-apps.md) — اعتبارسنجی `initData` مینی‌اپ (HMAC-SHA256، `max_age`، الگوی endpoint)
- [CHANGELOG.md](CHANGELOG.md) — تاریخچه نسخه‌ها

</div>
