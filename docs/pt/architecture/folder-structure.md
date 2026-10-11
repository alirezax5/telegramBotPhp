# Estrutura de Pastas

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

## Layout de src/

| Caminho | Finalidade |
|------|---------|
| `Telegram.php` | Classe principal — construída com um token; mantém o cliente HTTP, os dados de updates, o cache, a pilha de tokens e a configuração de retry. |
| `Traits/method.php` | Trait agregadora que faz `use` de todas as 7 traits de domínio + define os helpers privados compartilhados `call()`/`prepareBotData()`/de mídia. |
| `Traits/{Updates,Messages,ChatAdministration,Stickers,PaymentsAndGames,Business,BotSettings}.php` | **186 métodos da API**, agrupados por domínio da API. |
| `Traits/{isUpdates,isChatTypes,isMedia}.php` | Verificadores booleanos de tipo de update/chat/mídia. |
| `Traits/otherTrait.php` | Getters de conveniência (`text()`, `chatId()`, `fileId()`, ...). |
| `Types/BaseType.php` | Base abstrata para todos os tipos — `__get`/`toArray` lazy, `JsonSerializable`, iterável. |
| `Types/returned*.php` | Wrappers tipados de resposta (ex.: `returnedMessage`, `returnedUser`). |
| `Types/*.php` | Tipos de entidade (Message, User, Chat, InlineKeyboardMarkup, InputRichMessage, ...). |

```
motivo: o SDK mantém um perfil deliberadamente plano — todo o comportamento em Telegram (via traits), todos os dados como subclasses de BaseType.

Veja também [methods.md](methods.md) e [telegram-class.md](telegram-class.md).