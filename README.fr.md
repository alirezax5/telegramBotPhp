# telegramBotPhp

[English](README.md) · [فارسی](README.fa.md) · [中文](README.zh.md) · [Русский](README.ru.md) · **Français** · [Português](README.pt.md) · [العربية](README.ar.md)

Wrapper PHP 8.1+ léger pour l'**API Bot de Telegram** — zéro dépendance d'exécution, couverture complète de chaque méthode d'API actuelle (186 méthodes de bot) et de chaque type de réponse/entité (199 types).

Version actuelle : **3.3.0** — voir [CHANGELOG.md](CHANGELOG.md) (corrige un `getChatMember()` cassé dans la 3.2.1, achève la sérialisation JSON des paramètres imbriqués, supprime les null, corrige une fuite de timeout cURL ; flux multi-bots vérifiés en conditions réelles avec deux vrais bots).

## Prérequis

- PHP >= 8.1
- Extension cURL (`ext-curl`)
- Extension JSON (`ext-json`)
- Composer

## Installation

```bash
composer require alirezax5/telegram-bot-php
```

## Démarrage rapide

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

## Multi-bots (deux bots dans un même processus)

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

Guide complet : [docs/guides/multi-bot.md](docs/fr/guides/multi-bot.md).

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

`Telegram` intègre tous les traits métier via le trait agrégateur `method`.
Toutes les méthodes d'API renvoient un objet `returned*` (réponse) typé construit par `BaseType::create()`.

## Licence

MIT

## Documentation
- [architecture/overview.md](docs/fr/architecture/overview.md) — architecture complète
- [architecture/folder-structure.md](docs/fr/architecture/folder-structure.md)
- [architecture/methods.md](docs/fr/architecture/methods.md) — les 186 méthodes regroupées par trait
- [architecture/telegram-class.md](docs/fr/architecture/telegram-class.md) — référence de la classe centrale
- [architecture/type-system.md](docs/fr/architecture/type-system.md) — système de types et returned*
- [guides/webhook-vs-polling.md](docs/fr/guides/webhook-vs-polling.md)
- [guides/retry-and-resilience.md](docs/fr/guides/retry-and-resilience.md) — stratégie de reprise
- [guides/multi-bot.md](docs/fr/guides/multi-bot.md) — deux bots dans un même processus (pile de jetons, appels bruts)
- [CHANGELOG.md](CHANGELOG.md) — historique des versions
- [README.fa.md](README.fa.md) — documentation en persan (RTL)
