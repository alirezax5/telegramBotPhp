<div dir="rtl">

# telegramBotPhp

[English](README.md) · [فارسی](README.fa.md) · [中文](README.zh.md) · [Русский](README.ru.md) · [Français](README.fr.md) · [Português](README.pt.md) · **العربية**

غلاف خفيف الوزن للـ **Telegram Bot API** على PHP 8.1+ — بلا أي اعتماديات وقت تشغيل، مع تغطية كاملة لكل أسلوب API حالي (186 أسلوب بوت) وكل نوع استجابة/كيان (199 نوعًا).

الإصدار الحالي: **3.3.0** — راجع [CHANGELOG.md](CHANGELOG.md) (إصلاح `getChatMember()` المعطوبة في 3.2.1، وإكمال تسلسل JSON للمعاملات المتداخلة، وحذف القيم `null`، وإصلاح تسريب مهلة cURL؛ وتدفقات تعدد البوتات مُتحقَّق منها مباشرةً باستخدام بوتين حقيقيين).

## المتطلبات

- PHP >= 8.1
- امتداد cURL‏ (`ext-curl`)
- امتداد JSON‏ (`ext-json`)
- Composer

## التثبيت

```bash
composer require alirezax5/telegram-bot-php
```

## البداية السريعة

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

## تعدد البوتات (بوتان في عملية واحدة)

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

الدليل الكامل: [docs/guides/multi-bot.md](docs/ar/guides/multi-bot.md).

## التحقق من `initData` التطبيقات المصغّرة

تحصل واجهة التطبيق المصغّر من تلغرام على سلسلة هوية **موقّعة** (`Telegram.WebApp.initData`). تحقّق منها على الخادم قبل تقديم أي بيانات للمستخدم — `telegramBotApiPhp\WebApp\InitData` ينفّذ مخطط HMAC-SHA256 الرسمي بمقارنة زمن ثابت:

```php
use telegramBotApiPhp\WebApp\InitData;

$res = InitData::validate($_POST['initData'] ?? '', $botToken, ['max_age' => 3600]);
if (!$res['ok']) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => $res['error']]);
    exit;
}

$me         = $res['user'];         // ['id' => 555000111, 'first_name' => 'Ali', ...]
$startParam = $res['start_param'];  // من ?startapp=
```

الhelpers: `valid()` و `user()` و `build()` (مولّد initData موقّعة للاختبار فقط). الدليل الكامل: [docs/guides/mini-apps.md](docs/guides/mini-apps.md).

## البنية

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

يسحب الصنف `Telegram` جميع traits المجالات عبر trait التجميع `method`.
وكل أساليب الـ API تُعيد كائن `returned*` (استجابة) ممنوحًا بالأنواع يُبنى عبر `BaseType::create()`.

## الترخيص

MIT

## الوثائق
- [architecture/overview.md](docs/ar/architecture/overview.md) — البنية الكاملة
- [architecture/folder-structure.md](docs/ar/architecture/folder-structure.md)
- [architecture/methods.md](docs/ar/architecture/methods.md) — الأساليب الـ186 مجمّعة حسب trait
- [architecture/telegram-class.md](docs/ar/architecture/telegram-class.md) — مرجع الصنف الأساسي
- [architecture/type-system.md](docs/ar/architecture/type-system.md) — نظام الأنواع وreturned*
- [guides/webhook-vs-polling.md](docs/ar/guides/webhook-vs-polling.md)
- [guides/retry-and-resilience.md](docs/ar/guides/retry-and-resilience.md) — استراتيجية إعادة المحاولة
- [guides/multi-bot.md](docs/ar/guides/multi-bot.md) — بوتان في عملية واحدة (كومة التوكنات، الاستدعاءات الخام)
- [CHANGELOG.md](CHANGELOG.md) — سجل الإصدارات
- [README.fa.md](README.fa.md) — الوثائق الفارسية (RTL)

</div>
