# Classe centrale Telegram

`telegramBotApiPhp\Telegram` est l'unique objet racine. Construisez-le avec un jeton, appelez n'importe quelle méthode d'API, et lisez les données d'update via des getters de commodité.

## Construction

```php
new Telegram(
    string $token,
    string $apiUrl = 'https://api.telegram.org',
    string $fileUrlTemplate = '{url}/file/bot{token}/{file_path}',
    int    $maxRetries = 3,
    int    $retryDelayMs = 500,
    int    $curlTimeout = 30
)
```

`$curlTimeout` est borné à un minimum de 5. Pour le long polling, `getUpdates(timeout:)` relève le timeout cURL à `timeout+5` afin que la socket ne soit pas coupée en cours de polling.

## Données d'update

Le constructeur lit `php://input` (webhook) et le stocke sous forme de `stdClass`. Modifiez les données manuellement avec `setInputData()`, et lisez des vues typées via les getters :

```php
$bot->message();            // ?Message
$bot->callbackQuery();      // ?CallbackQuery
$bot->editedMessage();      // ?Message
$bot->channelPost();        // ?Message
$bot->poll();               // ?Poll
$bot->chatMember();         // ?ChatMemberUpdated
// ... 20+ typed getters
$bot->checkUpdateExists('message');   // bool
$bot->getUpdateId();                  // int
```

Les getters d'update sont **mis en cache** par update (le cache d'instance est vidé par `clearCache()` / `setInputData()`).

## Getters de commodité (issus de `otherTrait`)

`text()`, `caption()`, `messageID()`, `fromId()`, `chatId()`, `firstName()`,
`lastName()`, `username()`, `languageCode()`, `isPremium()`, `chatType()`,
`msgType()`, `mediaType()`, `fileId()`, `mimeType()`, `fileSize()`, `isReply()`,
`replyToMessageId()`, `pathToUrl()`. Ils acceptent les messages, les messages modifiés, les posts de
canal, les callback queries et les messages business.

`msgType()` renvoie l'une des valeurs `PRIVATE|_TEXT|_MEDIA|_FORWARD` ; `mediaType()` renvoie
`_PHOTO|_VIDEO|_AUDIO|_VOICE|...|_TEXT`.

## Bascule multi-jetons

```php
$bot->switchToken('new-token');   // push
$bot->restoreToken();             // pop
$bot->clearTokenStack();
$bot->getTokenStackCount();
```

## HTTP / résilience (Telegram::bot)

`bot(method, data, isUpload)` est l'appel HTTP de bas niveau. Il :
- réutilise un seul handle cURL (`close()` / `__destruct` le libèrent) ;
- réessaie jusqu'à `maxRetries` fois avec backoff exponentiel pour les erreurs réseau, les 5xx et les 429 ;
- en cas de HTTP 429, honore `parameters.retry_after` avant de réessayer ;
- renvoie un `stdClass` décodé en cas de succès, ou `['ok'=>false,'error'=>...,'http_code'=>...,'attempts'=>...]` après épuisement des tentatives.

`callRaw(method, data)` (public, issu du trait `method`) appelle l'API sans envelopper le résultat dans un objet typé — utile pour l'introspection brute.

## Accès direct de bas niveau

- `getFileUrl($filePath)` — construit une URL de téléchargement pour un fichier à partir de son chemin.
- `close()` — libère explicitement le handle cURL.

Voir [overview.md](overview.md) pour la carte des modules et [methods.md](methods.md) pour la liste complète des méthodes.
