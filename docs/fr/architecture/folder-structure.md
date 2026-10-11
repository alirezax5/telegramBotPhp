# Structure des dossiers

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

## Organisation de src/

| Chemin | Rôle |
|------|---------|
| `Telegram.php` | Classe centrale — construite avec un jeton ; concentre le client HTTP, les données d'update, le cache, la pile de jetons, la configuration de reprise. |
| `Traits/method.php` | Trait agrégateur qui `use` les 7 traits métier + définit les helpers privés partagés `call()`/`prepareBotData()`/media. |
| `Traits/{Updates,Messages,ChatAdministration,Stickers,PaymentsAndGames,Business,BotSettings}.php` | **186 méthodes d'API**, regroupées par domaine d'API. |
| `Traits/{isUpdates,isChatTypes,isMedia}.php` | Vérificateurs booléens de types d'updates/chats/médias. |
| `Traits/otherTrait.php` | Getters de commodité (`text()`, `chatId()`, `fileId()`, ...). |
| `Types/BaseType.php` | Classe de base abstraite de tous les types — `__get`/`toArray` paresseux, `JsonSerializable`, itérable. |
| `Types/returned*.php` | Wrappers de réponse typés (par ex. `returnedMessage`, `returnedUser`). |
| `Types/*.php` | Types d'entités (Message, User, Chat, InlineKeyboardMarkup, InputRichMessage, ...). |

```
reason: the SDK keeps a deliberately flat profile — all behaviour on Telegram (via traits), all data as BaseType subclasses.

Voir aussi [methods.md](methods.md) et [telegram-class.md](telegram-class.md).
