# Guide multi-bots

Faire fonctionner deux bots ou plus au sein d'un même processus PHP — vérifier l'appartenance à un canal avec le jeton d'un second bot, ou laisser le bot nº 1 envoyer des messages en tant que bot nº 2.

Deux modèles indépendants sont pris en charge. Les deux ont été vérifiés en conditions réelles avec deux vrais bots
(voir [CHANGELOG.md](../../../CHANGELOG.md) pour le tableau des preuves).

---

## Modèle 1 — Instances indépendantes

Chaque objet `Telegram` possède son propre jeton, son propre handle cURL et son propre cache d'updates. Rien n'est
partagé entre les instances, l'isolation des identités est donc garantie par construction :

```php
use telegramBotApiPhp\Telegram;

$bot1 = new Telegram($_ENV['BOT1_TOKEN']);
$bot2 = new Telegram($_ENV['BOT2_TOKEN']);

// Scenario A (owner request): membership check executed by bot #2's token,
// from inside bot #1's process.
$member = $bot2->getChatMember('@mychannel', $userId);
if (($member->result->status ?? '') === 'member') {
    // user is in the channel — checked by bot #2
}

$bot1->sendMessage($chatId, 'این پاسخ از ربات ۱ است');
$bot2->sendMessage($chatId, 'این پیام از ربات ۲ است');
```

## Modèle 2 — Pile de jetons sur une seule instance

Une instance de `Telegram` peut temporairement *devenir* un autre bot, envoyer, puis revenir en arrière.
La pile est LIFO : chaque `switchToken()` empile le jeton courant, `restoreToken()`
le dépile.

```php
// Scenario B (owner request): bot #1 sends AS bot #2, inside bot #1's process.
$bot1->switchToken($_ENV['BOT2_TOKEN']);
$bot1->sendMessage($chatId, 'این پیام توسط نمونهٔ ربات ۱، اما با هویت ربات ۲ ارسال شد');
$bot1->restoreToken();

// The same instance is bot #1 again:
$bot1->sendMessage($chatId, 'و این یکی دوباره از ربات ۱ است');
```

Helpers : `getToken()`, `switchToken(string $token)`, `restoreToken()`,
`clearTokenStack()`, `getTokenStackCount()`.

> Préférez le modèle 1 lorsque les deux bots sont utilisés en permanence — la pile est conçue pour
> de courts allers-retours encadrés. Le modèle 2 conserve un seul handle cURL (moins de sockets),
> le modèle 1 garde les identités définitivement séparées.

## Appels bruts

`callRaw(string $method, array $data = [])` exécute n'importe quelle méthode de l'API Bot et renvoie
la **réponse décodée complète** (`stdClass` avec `ok`, `result`, `description`,
`parameters.retry_after`) — utile pour les méthodes ajoutées récemment ou pour le diagnostic :

```php
$me    = $bot2->callRaw('getMe');          // $me->result->username
$probe = $bot2->callRaw('getChat', ['chat_id' => '@mychannel']);
```

## Intégration au framework (TelegramBase)

Le [framework TelegramBase](https://github.com/alirezax5/telegramBase) enveloppe cette
bibliothèque avec un registre `BotManager` :

- `BOT_EXTRA_BOTS="second:<token2>,third:<token3>"` (variable d'environnement) enregistre des bots nommés au démarrage ;
- les plugins les récupèrent via `BotManager::getInstance()->get('second')` ;
- `has('name')` doit être vérifié d'abord — `get()` avec un nom inconnu retombe silencieusement
  sur le bot **principal**, ce qui exécuterait l'appel sous la mauvaise identité ;
- voir `docs/en/multi-bot.md` dans le dépôt du framework.

## Un seul fichier webhook, plusieurs bots (routage par secret_token)

Vous pouvez servir **autant de bots que vous voulez depuis UN seul fichier webhook** —
aucun dossier supplémentaire, et les jetons de bot n'apparaissent jamais dans les URLs :

1. Donnez à **chaque bot son propre secret aléatoire** (`[A-Za-z0-9_-]`, 32 caractères
   ou plus).
2. Enregistrez la **même URL** pour chaque bot, chacun avec son propre secret :
   `setWebhook?url=https://example.com/hook.php&secret_token=<this-bots-secret>`
3. Telegram renvoie le secret à chaque update dans l'en-tête
   `X-Telegram-Bot-Api-Secret-Token`.
4. Dans `hook.php`, lisez l'en-tête, recherchez le secret dans un registre
   (`secret → jeton`), puis construisez l'instance de `Telegram` correspondante
   (modèle 1) et traitez l'update sous cette identité.

```php
// hook.php — tout le routeur en quelques lignes
$registry = [
    'secret-A...' => $_ENV['BOT1_TOKEN'],
    'secret-B...' => $_ENV['BOT2_TOKEN'],
];
$secret = $_SERVER['HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN'] ?? '';
if (!isset($registry[$secret])) { http_response_code(403); exit; }

$bot = new Telegram($registry[$secret]);           // l'identité de ce bot
$update = json_decode(file_get_contents('php://input'), true);
// ... traitez $update avec $bot ...
```

Le secret sert aussi de vérification d'authenticité (les requêtes qui en sont dépourvues
ne viennent pas de Telegram — répondez `403`). Vérifié en conditions réelles le
2026-10-11 : deux vrais bots, un seul fichier, 7/7 livraisons avec la bonne identité à
chaque fois.

Options de stockage des jetons, version courte : un ensemble fixe de bots → `.env` ; des
bots ajoutés à l'exécution → une table en base de données avec la colonne de jetons
**chiffrée au repos** (mettez la recherche en cache) ; des enfants créés par les
utilisateurs → Managed Bots, jeton récupéré à la volée auprès de Telegram avec
`getManagedBotToken($user_id)` et jamais écrit sur disque.

## Pièges

- **Repli de `get()`** : appeler `get('unknown-name')` renvoie le bot principal (avec un
  log d'avertissement) au lieu de lever une exception — protégez toujours avec `has()`.
- **La pile de jetons est propre à chaque instance** : basculer les jetons sur `$bot1` n'affecte pas `$bot2`.
- **Restore déséquilibré** : si vous appelez `switchToken()` sans `restoreToken()` correspondant
  sur un chemin d'exception, l'instance conserve l'identité empruntée. Utilisez try/finally :
  ```php
  $bot1->switchToken($t2);
  try {
      $bot1->sendMessage($chatId, 'as bot #2');
  } finally {
      $bot1->restoreToken();
  }
  ```
- **Uploads de fichiers dans les champs JSON** : les chemins locaux pour `stickers`, `media`, etc. sont
  convertis automatiquement en `CURLFile` (v3.3.0+) — mais uniquement avant l'encodage JSON, passez donc
  toujours des tableaux PHP (pas des chaînes JSON pré-encodées) pour ces paramètres.

## Vérification en conditions réelles (2026-10-11)

Deux vrais bots (`@emojiCustom_bot` en nº 1, `@instaroonxbot` en nº 2), un seul processus PHP :

| Étape | Résultat |
|---|---|
| Identité : `getMe` via les deux instances | ✔ deux noms d'utilisateur |
| Isolation : les appels du bot nº 2 n'ont jamais touché le jeton du bot nº 1 | ✔ |
| Envoi croisé (modèle 2) : le bot nº 1 envoie en tant que bot nº 2 → chat de l'utilisateur | ✔ 239 ms |
| Appartenance (modèle 1) : `getChatMember` via le bot nº 2 | ✔ `status=member`, 13 ms |
| Aller-retour de la pile de jetons sur l'instance principale | ✔ switch → @instaroonxbot, restore → @emojiCustom_bot |
| Suite complète du harnais | ✔ 5/5, 393 ms au total |
| Routage webhook par secret_token : les deux bots → UN seul fichier, vrai `/start` + vrais appuis sur les boutons | ✔ 7/7, bonne identité à chaque fois |
