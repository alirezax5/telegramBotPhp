# Retry e Resiliência

O SDK traz uma pequena camada de confiabilidade HTTP embutida em `Telegram::bot()`.

## Política de retry

- **Tentativas:** até `maxRetries` novas tentativas (padrão **3**) após a primeira requisição.
- **Gatilhos de retry:** erro de cURL/rede, erro de servidor `5xx` e `429` (limite de taxa).
- **Backoff:** exponencial — `retryDelayMs * 2^(attempt-1)` (primeiro atraso padrão 500ms → 1s → 2s).
- **Honrar o 429:** se a resposta da API trouxer `parameters.retry_after`, o cliente aguarda exatamente esse número de **segundos** antes de tentar novamente (em vez da estimativa exponencial). Isso evita martelar o limitador de taxa.

## Comportamento do cURL

- Um único handle de cURL é criado sob demanda (lazy) e **reutilizado** entre as chamadas (reuso de conexão sob long polling). Libere-o com `close()` ou na destruição.
- `CURLOPT_TIMEOUT` tem como padrão 30s (`$curlTimeout` no construtor). Para `getUpdates` de long polling com um `timeout` explícito, o timeout do socket é elevado para `timeout + 5` para que uma resposta lenta de long polling não seja cortada.
- A verificação SSL está ATIVADA (`CURLOPT_SSL_VERIFYPEER => true`).

## Forma do retorno em caso de falha

Quando as tentativas se esgotam, `bot()` retorna um `stdClass`:

```php
(object)[
    'ok'       => false,
    'error'    => 'curl error message' ?: 'API Error after N attempts',
    'http_code'=> 200|429|5xx|0,
    'attempts' => N,
];
```

`callRaw()` retorna esse objeto bruto; os métodos tipados embrulham o campo `result` se presente.

## Na prática

```php
$bot = new Telegram($token, maxRetries: 5, retryDelayMs: 300, curlTimeout: 60);

$res = $bot->sendMessage($chatId, 'Hi');
if (!($res->ok ?? false)) {
    // handle API error via $res->error / $res->http_code
}
```
