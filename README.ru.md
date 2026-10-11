# telegramBotPhp

[English](README.md) · [فارسی](README.fa.md) · [中文](README.zh.md) · **Русский** · [Français](README.fr.md) · [Português](README.pt.md) · [العربية](README.ar.md)

Лёгкая обёртка PHP 8.1+ для **Telegram Bot API** — ноль зависимостей времени выполнения, полное покрытие каждого актуального метода API (186 методов бота) и каждого типа ответов/сущностей (199 типов).

Текущий релиз: **3.3.0** — см. [CHANGELOG.md](CHANGELOG.md) (исправлен сломанный `getChatMember()` в 3.2.1, завершена JSON-сериализация вложенных параметров, вырезаются null, исправлена утечка тайм-аута cURL; сценарии с несколькими ботами проверены вживую с двумя реальными ботами).

## Требования

- PHP >= 8.1
- Расширение cURL (`ext-curl`)
- Расширение JSON (`ext-json`)
- Composer

## Установка

```bash
composer require alirezax5/telegram-bot-php
```

## Быстрый старт

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

## Несколько ботов (два бота в одном процессе)

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

Полное руководство: [docs/ru/guides/multi-bot.md](docs/ru/guides/multi-bot.md).

## Архитектура

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

`Telegram` подключает все доменные трейты через трейт-агрегатор `method`.
Все методы API возвращают типизированный объект `returned*` (ответ), создаваемый через `BaseType::create()`.

## Лицензия

MIT

## Документация
- [architecture/overview.md](docs/ru/architecture/overview.md) — полная архитектура
- [architecture/folder-structure.md](docs/ru/architecture/folder-structure.md)
- [architecture/methods.md](docs/ru/architecture/methods.md) — 186 методов, сгруппированных по трейтам
- [architecture/telegram-class.md](docs/ru/architecture/telegram-class.md) — справочник по основному классу
- [architecture/type-system.md](docs/ru/architecture/type-system.md) — система типов и returned*
- [guides/webhook-vs-polling.md](docs/ru/guides/webhook-vs-polling.md)
- [guides/retry-and-resilience.md](docs/ru/guides/retry-and-resilience.md) — стратегия повторов
- [guides/multi-bot.md](docs/ru/guides/multi-bot.md) — два бота в одном процессе (стек токенов, «сырые» вызовы)
- [CHANGELOG.md](CHANGELOG.md) — история релизов
- [README.fa.md](README.fa.md) — документация на фарси (RTL)
