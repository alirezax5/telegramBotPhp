# telegramBotPhp

**English** · [فارسی](README.fa.md) · [中文](README.zh.md) · [Русский](README.ru.md) · [Français](README.fr.md) · [Português](README.pt.md) · [العربية](README.ar.md)

Lightweight PHP 8.1+ wrapper for the **Telegram Bot API** — zero runtime dependencies, full coverage of every current API method (186 bot methods) and every response/entity type (199 types).

Current release: **3.4.0** — see [CHANGELOG.md](CHANGELOG.md) (fixes a broken `getChatMember()` in 3.2.1, completes JSON serialization of nested parameters, strips nulls, fixes a cURL timeout leak; multi-bot flows verified live with two real bots).

## Requirements

- PHP >= 8.1
- cURL extension (`ext-curl`)
- JSON extension (`ext-json`)
- Composer

## Installation

```bash
composer require alirezax5/telegram-bot-php
```

## Quick Start

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

## Multi-bot (two bots in one process)

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

Full guide: [docs/guides/multi-bot.md](docs/guides/multi-bot.md).

## Mini App `initData` validation

A Mini App frontend gets a **signed** identity string from Telegram (`Telegram.WebApp.initData`). Verify it server-side before serving any user data — `telegramBotApiPhp\WebApp\InitData` implements the official HMAC-SHA256 scheme with constant-time comparison:

```php
use telegramBotApiPhp\WebApp\InitData;

$res = InitData::validate($_POST['initData'] ?? '', $botToken, ['max_age' => 3600]);
if (!$res['ok']) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => $res['error']]);   // bad_signature, auth_date_expired, ...
    exit;
}

$me        = $res['user'];        // ['id' => 555000111, 'first_name' => 'Ali', ...]
$startParam = $res['start_param']; // deep-link payload from ?startapp=...
```

Helpers: `valid()`, `user()`, and `build()` — a dev-only generator of correctly signed initData strings for testing endpoints before the frontend exists. Full guide: [docs/guides/mini-apps.md](docs/guides/mini-apps.md).

## Architecture

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

`Telegram` pulls in all domain traits via the `method` aggregator trait.
All API methods return a typed `returned*` (response) object built by `BaseType::create()`.
Mini App identity validation lives in `src/WebApp/InitData.php` (standalone, no bot-API dependency).

## License

MIT

## Documentation
- [architecture/overview.md](docs/architecture/overview.md) — full architecture
- [architecture/folder-structure.md](docs/architecture/folder-structure.md)
- [architecture/methods.md](docs/architecture/methods.md) — the 186 methods grouped by trait
- [architecture/telegram-class.md](docs/architecture/telegram-class.md) — core class reference
- [architecture/type-system.md](docs/architecture/type-system.md) — type system & returned*
- [guides/webhook-vs-polling.md](docs/guides/webhook-vs-polling.md)
- [guides/retry-and-resilience.md](docs/guides/retry-and-resilience.md) — retry strategy
- [guides/multi-bot.md](docs/guides/multi-bot.md) — two bots in one process (token stack, raw calls)
- [guides/mini-apps.md](docs/guides/mini-apps.md) — Mini App `initData` validation (HMAC-SHA256, `max_age`, endpoint pattern)
- [CHANGELOG.md](CHANGELOG.md) — release history
- [README.fa.md](README.fa.md) — مستندات فارسی (RTL)
