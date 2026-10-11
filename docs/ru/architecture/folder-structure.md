# Структура папок

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

## Расположение src/

| Путь | Назначение |
|------|------------|
| `Telegram.php` | Основной класс — создаётся с токеном; содержит HTTP-клиент, данные апдейтов, кэш, стек токенов, конфигурацию повторов. |
| `Traits/method.php` | Трейт-агрегатор, который подключает через `use` все 7 доменных трейтов + определяет общие приватные хелперы `call()`/`prepareBotData()`/медиа. |
| `Traits/{Updates,Messages,ChatAdministration,Stickers,PaymentsAndGames,Business,BotSettings}.php` | **186 методов API**, сгруппированных по доменам API. |
| `Traits/{isUpdates,isChatTypes,isMedia}.php` | Булевы проверки типов апдейтов/чатов/медиа. |
| `Traits/otherTrait.php` | Удобные геттеры (`text()`, `chatId()`, `fileId()`, ...). |
| `Types/BaseType.php` | Абстрактная база для всех типов — ленивые `__get`/`toArray`, `JsonSerializable`, итерируемость. |
| `Types/returned*.php` | Типизированные обёртки ответов (например, `returnedMessage`, `returnedUser`). |
| `Types/*.php` | Типы-сущности (Message, User, Chat, InlineKeyboardMarkup, InputRichMessage, ...). |

```
reason: the SDK keeps a deliberately flat profile — all behaviour on Telegram (via traits), all data as BaseType subclasses.

См. также [methods.md](methods.md) и [telegram-class.md](telegram-class.md).
