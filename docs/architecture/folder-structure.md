# Folder Structure

```
telegramBotPhp/
├── README.md                  # Quick start + install + index
├── composer.json              # PSR-4: telegramBotApiPhp\ => src/
├── src/
│   ├── Telegram.php           # Core class (root object)
│   ├── Traits/                # All behaviour is mixed in here
│   └── Types/                 # Response & entity classes
└── docs/
    ├── architecture/          # Design docs (this tree)
    └── guides/                # How-to guides
```

## src/ layout

| Path | Purpose |
|------|---------|
| `Telegram.php` | Core class — constructed with a token; holds the HTTP client, update data, cache, token stack, retry config. |
| `Traits/method.php` | Aggregator trait that `use`s all 7 domain traits + defines shared private `call()`/`prepareBotData()`/media helpers. |
| `Traits/{Updates,Messages,ChatAdministration,Stickers,PaymentsAndGames,Business,BotSettings}.php` | **186 API methods**, grouped by API domain. |
| `Traits/{isUpdates,isChatTypes,isMedia}.php` | Boolean update/chat/media type checkers. |
| `Traits/otherTrait.php` | Convenience getters (`text()`, `chatId()`, `fileId()`, ...). |
| `Types/BaseType.php` | Abstract base for all types — lazy `__get`/`toArray`, `JsonSerializable`, iterable. |
| `Types/returned*.php` | Typed response wrappers (e.g. `returnedMessage`, `returnedUser`). |
| `Types/*.php` | Entity types (Message, User, Chat, InlineKeyboardMarkup, InputRichMessage, ...). |

```
reason: the SDK keeps a deliberately flat profile — all behaviour on Telegram (via traits), all data as BaseType subclasses.

See also [methods.md](methods.md) and [telegram-class.md](telegram-class.md).