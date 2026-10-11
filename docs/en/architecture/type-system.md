# Type System

Every JSON response from the Bot API is decoded to `stdClass`, then wrapped in a `BaseType` subclass (lazy, magic `__get`).

## BaseType

`telegramBotApiPhp\Types\BaseType` (abstract) implements:

- `__get(string $name): mixed` — reads from the underlying array; returns `null` for missing keys.
- `__isset(string $name): bool`
- `getIterator(): \Traversable`
- `toArray(): array` — recursive: nested `BaseType` and arrays of `BaseType` are converted.
- `jsonSerialize(): array` — so `json_encode($type)` works.
- `static create(array|object $data): static` — factory used by all API methods.

Data arrives either as `stdClass` (constructor converts via `get_object_vars`) or an array, or another `BaseType`.

## returned* response wrappers

Each API method returns a **response** type such as:

| Response class | Result payload |
|----------------|----------------|
| `returned`               | `bool` (ok) |
| `returnedMessage`        | `Message` |
| `returnedUser`           | `User` |
| `returnedChat`           | `ChatFullInfo` |
| `returnedChatMember`     | `ChatMember` |
| `returnedFile`           | `File` |
| `returnedBotShortDescription` | `BotShortDescription` |
| `returnedArrayOfMessageId`, `returnedArrayOfChatMember`, ... | arrays of entities |
| `returnedInt`, `returnedString` | scalar |

They are thin typed wrappers: `ok`, `error_code`, `description` + `result`.

## Entity types

Message, User, Chat, ChatMember, StickerSet, Poll, GameHighScore, InlineQueryResult, InputMedia, InputRichMessage, etc. — 199 classes total, all extending `BaseType`.

## Why magic properties instead of typed public props?

- Zero maintenance: new API fields appear automatically (forward-compatible).
- The raw update/response objects stay the single source of truth.
- Trade-off: no IDE autocomplete for fields (see refactoring ideas in [methods.md](methods.md) / project roadmap).

To get raw data back: `$type->toArray()` or `json_encode($type)`.