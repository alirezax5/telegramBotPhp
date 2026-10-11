<div dir="rtl">

[English](README.md) · **فارسی** · [中文](README.zh.md) · [Русский](README.ru.md) · [Français](README.fr.md) · [Português](README.pt.md) · [العربية](README.ar.md)

# telegramBotPhp — مستندات فارسی

کتابخانه‌ای سبک برای **Telegram Bot API** روی PHP 8.1+ — بدون هیچ وابستگی زمان اجرا، با پوشش کامل تمام متدهای فعلی API (186 متد ربات) و تمام انواع پاسخ/موجودیت (199 تایپ).

نسخه فعلی: **3.3.0** — [CHANGELOG.md](CHANGELOG.md) را ببینید (رفع `getChatMember()` شکسته در 3.2.1، تکمیل سریال‌سازی JSON پارامترهای تودرتو، حذف مقادیر null و تبدیل خودکار فایل‌های محلی به `CURLFile`، رفع نشتی timeout cURL؛ جریان‌های چندرباته با دو ربات واقعی به‌صورت زنده راستی‌آزمایی شده‌اند).

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

// Long polling
$bot = new Telegram($_ENV['TELEGRAM_BOT_TOKEN']);

$updates = $bot->getUpdates(0, 100, 50);       // offset, limit, long-poll timeout (s)
foreach ($updates->result as $u) {
    $bot->setInputData($u);
    $chatId = $bot->chatId();
    $text   = $bot->text();

    if ($text === '/start') {
        $bot->sendMessage($chatId, 'Welcome!');
    }
}

// Webhook mode
$update = $bot->getInputData();                   // decodes php://input
if ($bot->isMessage()) {
    $bot->sendMessage($chatId, $bot->text());
}
```

## چندرباته (دو ربات در یک پروسه)

```php
// Pattern 1 — independent instances (e.g. membership check via bot #2)
$bot2 = new Telegram($_ENV['BOT2_TOKEN']);
$member = $bot2->getChatMember('@mychannel', $userId);
$status = $member->result->status ?? 'left';      // member | administrator | creator | left | kicked

// Pattern 2 — token stack: bot #1 sends AS bot #2
$bot->switchToken($_ENV['BOT2_TOKEN']);
$bot->sendMessage($chatId, 'Sent as bot #2, from the bot #1 process');
$bot->restoreToken();

// Raw API access (full stdClass response)
$me = $bot->callRaw('getMe');
```

راهنمای کامل: [docs/guides/multi-bot.md](docs/fa/guides/multi-bot.md).

## معماری

```
src/
├── Telegram.php          # Core class — HTTP client, update parser, token stack, caching, retry
├── Traits/
│   ├── Updates.php            # polling + webhook methods (getUpdates, setWebhook, getMe, ...)
│   ├── Messages.php          # 45 messaging methods (send*, edit*, ephemeral, rich)
│   ├── ChatAdministration.php# 51 chat/admin/forum methods
│   ├── Stickers.php          # 16 sticker-set methods
│   ├── PaymentsAndGames.php  # 11 payments/stars/games methods
│   ├── Business.php          # 36 business/managed-bot/story/inline/user-verify methods
│   ├── BotSettings.php       # 20 bot-profile/commands/menu methods
│   ├── isUpdates.php         # Boolean checkers for update types (23)
│   ├── isChatTypes.php       # Boolean checkers for chat types
│   ├── isMedia.php           # Boolean checkers for media types
│   └── otherTrait.php        # Convenience getters (messageID, text, chatId, mediaType, ...)
└── Types/                    # 199 typed response wrappers (BaseType subclass)
```

کلاس `Telegram` همه traitهای دامنه‌ای را از طریق trait تجمیع‌گر `method` به کار می‌گیرد.
خروجی همه متدهای API، آبجکت تایپ‌شده `returned*` است که با `BaseType::create()` ساخته می‌شود.

## مجوز

MIT

## مستندات

- [architecture/overview.md](docs/fa/architecture/overview.md) — معماری کامل
- [architecture/folder-structure.md](docs/fa/architecture/folder-structure.md)
- [architecture/methods.md](docs/fa/architecture/methods.md) — 186 متد به تفکیک trait
- [architecture/telegram-class.md](docs/fa/architecture/telegram-class.md) — مرجع کلاس اصلی
- [architecture/type-system.md](docs/fa/architecture/type-system.md) — سیستم تایپ و returned*
- [guides/webhook-vs-polling.md](docs/fa/guides/webhook-vs-polling.md)
- [guides/retry-and-resilience.md](docs/fa/guides/retry-and-resilience.md) — استراتژی retry
- [guides/multi-bot.md](docs/fa/guides/multi-bot.md) — دو ربات در یک پروسه (توکن‌استک، فراخوانی خام)
- [CHANGELOG.md](CHANGELOG.md) — تاریخچه نسخه‌ها
- [README.fa.md](README.fa.md) — مستندات فارسی (RTL)

</div>
