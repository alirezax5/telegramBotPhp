# Système de types

Chaque réponse JSON de l'API Bot est décodée en `stdClass`, puis enveloppée dans une sous-classe de `BaseType` (lazy, `__get` magique).

## BaseType

`telegramBotApiPhp\Types\BaseType` (abstraite) implémente :

- `__get(string $name): mixed` — lit dans le tableau sous-jacent ; renvoie `null` pour les clés absentes.
- `__isset(string $name): bool`
- `getIterator(): \Traversable`
- `toArray(): array` — récursif : les `BaseType` imbriqués et les tableaux de `BaseType` sont convertis.
- `jsonSerialize(): array` — afin que `json_encode($type)` fonctionne.
- `static create(array|object $data): static` — fabrique utilisée par toutes les méthodes d'API.

Les données arrivent soit sous forme de `stdClass` (le constructeur convertit via `get_object_vars`), soit d'un tableau, soit d'un autre `BaseType`.

## Wrappers de réponse returned*

Chaque méthode d'API renvoie un type de **réponse** tel que :

| Classe de réponse | Charge utile du résultat |
|----------------|----------------|
| `returned`               | `bool` (ok) |
| `returnedMessage`        | `Message` |
| `returnedUser`           | `User` |
| `returnedChat`           | `ChatFullInfo` |
| `returnedChatMember`     | `ChatMember` |
| `returnedFile`           | `File` |
| `returnedBotShortDescription` | `BotShortDescription` |
| `returnedArrayOfMessageId`, `returnedArrayOfChatMember`, ... | tableaux d'entités |
| `returnedInt`, `returnedString` | scalaire |

Ce sont de fins wrappers typés : `ok`, `error_code`, `description` + `result`.

## Types d'entités

Message, User, Chat, ChatMember, StickerSet, Poll, GameHighScore, InlineQueryResult, InputMedia, InputRichMessage, etc. — 199 classes au total, toutes étendant `BaseType`.

## Pourquoi des propriétés magiques plutôt que des propriétés publiques typées ?

- Zéro maintenance : les nouveaux champs d'API apparaissent automatiquement (compatibilité ascendante).
- Les objets bruts d'update/réponse restent l'unique source de vérité.
- Contrepartie : pas d'autocomplétion IDE pour les champs (voir les idées de refactoring dans [methods.md](methods.md) / la feuille de route du projet).

Pour retrouver les données brutes : `$type->toArray()` ou `json_encode($type)`.
