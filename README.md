# telegramBotPhp

Lightweight PHP 8.1+ wrapper for the **Telegram Bot API** — zero runtime dependencies, full coverage of every current API method (186 bot methods) and every response/entity type (199 types).

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

## Architecture

```
src/
├── Telegram.php          # Core class — DI/container, HTTP client, update parser, token stack, caching, retry
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

## License

MIT

## Documentation
- [architecture/overview.md](docs/architecture/overview.md) — full architecture
- [architecture/folder-structure.md](docs/architecture/folder-structure.md)
- [architecture/methods.md](docs/architecture/methods.md) — the 186 methods grouped by trait
- [architecture/telegram-class.md](docs/architecture/telegram-class.md) — core class reference
- [architecture/type-system.md](docs/architecture/type-system.md) — type system & returned*
- [guides/webhook-vs-polling.md](docs/guides/webhook-vs-polling.md)
- [guides/retry-and-resilience.md](docs/guides/retry-and-resilience.md)