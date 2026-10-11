# Sistema de Tipos

Toda resposta JSON da API de Bot é decodificada para `stdClass` e depois embrulhada em uma subclasse de `BaseType` (lazy, `__get` mágico).

## BaseType

`telegramBotApiPhp\Types\BaseType` (abstrata) implementa:

- `__get(string $name): mixed` — lê do array subjacente; retorna `null` para chaves ausentes.
- `__isset(string $name): bool`
- `getIterator(): \Traversable`
- `toArray(): array` — recursivo: `BaseType` aninhados e arrays de `BaseType` são convertidos.
- `jsonSerialize(): array` — para que `json_encode($type)` funcione.
- `static create(array|object $data): static` — fábrica usada por todos os métodos da API.

Os dados chegam como `stdClass` (o construtor converte via `get_object_vars`), como um array ou como outro `BaseType`.

## Wrappers de resposta returned*

Cada método da API retorna um tipo de **resposta** como:

| Classe de resposta | Payload do resultado |
|----------------|----------------|
| `returned`               | `bool` (ok) |
| `returnedMessage`        | `Message` |
| `returnedUser`           | `User` |
| `returnedChat`           | `ChatFullInfo` |
| `returnedChatMember`     | `ChatMember` |
| `returnedFile`           | `File` |
| `returnedBotShortDescription` | `BotShortDescription` |
| `returnedArrayOfMessageId`, `returnedArrayOfChatMember`, ... | arrays de entidades |
| `returnedInt`, `returnedString` | escalar |

São wrappers tipados enxutos: `ok`, `error_code`, `description` + `result`.

## Tipos de entidade

Message, User, Chat, ChatMember, StickerSet, Poll, GameHighScore, InlineQueryResult, InputMedia, InputRichMessage, etc. — 199 classes no total, todas estendendo `BaseType`.

## Por que propriedades mágicas em vez de propriedades públicas tipadas?

- Manutenção zero: novos campos da API aparecem automaticamente (forward-compatible).
- Os objetos brutos de update/resposta permanecem a única fonte da verdade.
- Contrapartida: sem autocomplete de IDE para os campos (veja ideias de refatoração em [methods.md](methods.md) / roadmap do projeto).

Para obter os dados brutos de volta: `$type->toArray()` ou `json_encode($type)`.
