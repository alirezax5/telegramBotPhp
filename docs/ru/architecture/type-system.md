# Система типов

Каждый JSON-ответ от Bot API декодируется в `stdClass`, затем заворачивается в подкласс `BaseType` (ленивый, магический `__get`).

## BaseType

`telegramBotApiPhp\Types\BaseType` (абстрактный) реализует:

- `__get(string $name): mixed` — читает из лежащего в основе массива; возвращает `null` для отсутствующих ключей.
- `__isset(string $name): bool`
- `getIterator(): \Traversable`
- `toArray(): array` — рекурсивно: вложенные `BaseType` и массивы `BaseType` конвертируются.
- `jsonSerialize(): array` — чтобы работал `json_encode($type)`.
- `static create(array|object $data): static` — фабрика, используемая всеми методами API.

Данные приходят либо как `stdClass` (конструктор преобразует их через `get_object_vars`), либо как массив, либо как другой `BaseType`.

## Обёртки ответов returned*

Каждый метод API возвращает **тип-ответ**, например:

| Класс ответа | Полезная нагрузка результата |
|----------------|----------------|
| `returned`               | `bool` (ok) |
| `returnedMessage`        | `Message` |
| `returnedUser`           | `User` |
| `returnedChat`           | `ChatFullInfo` |
| `returnedChatMember`     | `ChatMember` |
| `returnedFile`           | `File` |
| `returnedBotShortDescription` | `BotShortDescription` |
| `returnedArrayOfMessageId`, `returnedArrayOfChatMember`, ... | массивы сущностей |
| `returnedInt`, `returnedString` | скаляр |

Это тонкие типизированные обёртки: `ok`, `error_code`, `description` + `result`.

## Типы-сущности

Message, User, Chat, ChatMember, StickerSet, Poll, GameHighScore, InlineQueryResult, InputMedia, InputRichMessage и т.д. — всего 199 классов, все наследуют `BaseType`.

## Почему магические свойства, а не типизированные публичные свойства?

- Нулевое сопровождение: новые поля API появляются автоматически (прямая совместимость).
- «Сырые» объекты апдейта/ответа остаются единственным источником истины.
- Компромисс: отсутствует автодополнение в IDE для полей (см. идеи рефакторинга в [methods.md](methods.md) / дорожной карте проекта).

Чтобы получить «сырые» данные обратно: `$type->toArray()` или `json_encode($type)`.
