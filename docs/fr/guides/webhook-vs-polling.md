# Webhook vs long polling

Le SDK prend en charge les deux modes de livraison — le choix se fait au niveau de l'application.

## Webhook (HTTPS requis)

```php
$bot = new Telegram($token);
$update = $bot->getInputData();      // decodes php://input

if ($bot->isMessage()) {
    $bot->sendMessage($bot->chatId(), $bot->text());
}
```

- **Avantages :** temps réel, aucune charge de polling, aucune connexion maintenue ouverte.
- **Inconvénients :** nécessite un endpoint HTTPS public ; callbacks journalisés par Telegram.

### Mise en place

```php
$bot->setWebhook('https://example.com/hook');
$bot->getWebhookInfo();
$bot->deleteWebhook();
```

> Note : le format moderne permet `secret_token`, `max_connections`, `allowed_updates` via le tableau `$options`.

## Long polling (aucun serveur public requis)

```php
$bot = new Telegram($token);
$offset = 0;

while (true) {
    $updates = $bot->getUpdates($offset, 100, 50);   // offset, limit, longpoll timeout(s)
    foreach ($updates->result as $u) {
        $offset = max($offset, $u->update_id + 1);
        $bot->setInputData($u);
        // ...handle
    }
    usleep(200_000);   // 0.2s
}
```

- **Avantages :** fonctionne derrière une NAT, pas de TLS nécessaire, simple.
- **Inconvénients :** maintient une socket ouverte ; chaque poll est un aller-retour réseau.

**Note sur le timeout du long polling :** le timeout cURL par défaut du SDK est de 30 s, mais pour `getUpdates` le timeout transmis à Telegram est utilisé et le timeout cURL est relevé à `timeout + 5` afin que la requête HTTP ne soit pas coupée avant la réponse de Telegram.

### Durée de vie / instance unique

Lancez exactement un processus de polling par bot. Deux processus partageant l'offset de `getUpdates` peuvent consommer silencieusement les updates l'un de l'autre (voir le débogage *bot silencieux*). Utilisez un gestionnaire de processus (systemd / supervisor) pour le maintenir en vie, pas plusieurs processus concurrents.

## Choisir

- Produits publics ouverts au public (webhook Telegram) → **webhook.
- Dév/local derrière une NAT → **polling.
- Hébergement mutualisé ne pouvant pas maintenir un processus ouvert → le polling avec un script déclenché par cron convient pour un usage peu fréquent, mais pour un volume Telegram, un processus persistant est préférable.
