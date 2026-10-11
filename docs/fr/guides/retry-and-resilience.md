# Reprise et résilience

Le SDK embarque une petite couche de fiabilité HTTP intégrée dans `Telegram::bot()`.

## Politique de reprise

- **Tentatives :** jusqu'à `maxRetries` réessais (par défaut **3**) après la première requête.
- **Déclencheurs de reprise :** erreur cURL/réseau, erreur serveur `5xx`, et `429` (limite de débit).
- **Backoff :** exponentiel — `retryDelayMs * 2^(attempt-1)` (premier délai par défaut de 500 ms → 1 s → 2 s).
- **Honorisation du 429 :** si la réponse de l'API transporte `parameters.retry_after`, le client attend exactement ce nombre de **secondes** avant de réessayer (plutôt que l'estimation exponentielle). Cela évite de marteler le limiteur de débit.

## Comportement cURL

- Un seul handle cURL est créé paresseusement et **réutilisé** d'un appel à l'autre (réutilisation des connexions sous long polling). Libérez-le avec `close()` ou à la destruction.
- `CURLOPT_TIMEOUT` vaut 30 s par défaut (`$curlTimeout` du constructeur). Pour un `getUpdates` en long polling avec un `timeout` explicite, le timeout de la socket est relevé à `timeout + 5` afin qu'une réponse de long polling lente ne soit pas coupée.
- La vérification SSL est ACTIVE (`CURLOPT_SSL_VERIFYPEER => true`).

## Forme du retour en cas d'échec

Lorsque les réessais sont épuisés, `bot()` renvoie un `stdClass` :

```php
(object)[
    'ok'       => false,
    'error'    => 'curl error message' ?: 'API Error after N attempts',
    'http_code'=> 200|429|5xx|0,
    'attempts' => N,
];
```

`callRaw()` renvoie cet objet brut ; les méthodes typées enveloppent le champ `result` s'il est présent.

## En pratique

```php
$bot = new Telegram($token, maxRetries: 5, retryDelayMs: 300, curlTimeout: 60);

$res = $bot->sendMessage($chatId, 'Hi');
if (!($res->ok ?? false)) {
    // handle API error via $res->error / $res->http_code
}
```
