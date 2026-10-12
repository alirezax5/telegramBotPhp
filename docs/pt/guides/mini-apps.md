# Mini Apps — validação do `initData`

O frontend de um Mini App recebe do Telegram uma string **assinada** `Telegram.WebApp.initData` que prova qual usuário está vendo a página. O backend deve verificar a assinatura antes de servir dados.

- SDK: `telegramBotApiPhp\WebApp\InitData`

> **Nunca confie no `initDataUnsafe`** — mesmos campos sem assinatura; o tráfego do Mini App **não passa** pelo webhook — o navegador chama seu domínio diretamente.

## Uso no backend

```php
use telegramBotApiPhp\WebApp\InitData;

$raw = $_POST['initData'] ?? null;
if (!is_string($raw) || $raw === '') {
    $json = json_decode((string) file_get_contents('php://input'), true);
    $raw  = is_array($json) ? (string) ($json['initData'] ?? '') : '';
}

$res = InitData::validate((string) $raw, BOT_TOKEN, ['max_age' => 3600]);

if (!$res['ok']) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => $res['error']]);
    exit;
}

$user       = $res['user'];        // ['id' => ..., 'first_name' => ...]
$startParam = $res['start_param']; // ?startapp=
```

## API

| Método | Função |
|---|---|
| `validate()` | Resultado completo: `ok`, `user`, `auth_date`, `start_param`, `fields`, `hash` |
| `valid()` | Apenas booleano |
| `user()` | Array do usuário ou `null` |
| `build()` | Gera initData assinada (apenas testes) |

Opções: `max_age` — idade máxima do `auth_date` em segundos (padrão `86400`, `0` desativa a checagem). Erros: `empty_init_data`, `bot_token_missing`, `malformed_init_data`, `hash_missing`, `bad_signature`, `auth_date_missing`, `auth_date_expired`.

## Checklist de segurança

- Valide no servidor **cada** requisição privilegiada; mantenha `max_age` curto (`3600` ou menos).
- Comparação via `hash_equals` (tempo constante) — nunca `===`.
- Não registre `initData` nem tokens em logs.
- Algoritmo: `secret = HMAC_SHA256("WebAppData", token)` e depois `HMAC_SHA256(secret, data_check_string)` — guia completo: [mini-apps.md](mini-apps.md).
