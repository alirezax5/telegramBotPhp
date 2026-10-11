# Webhook vs Long Polling

O SDK suporta ambos os modos de entrega — você escolhe no nível da aplicação.

## Webhook (HTTPS obrigatório)

```php
$bot = new Telegram($token);
$update = $bot->getInputData();      // decodes php://input

if ($bot->isMessage()) {
    $bot->sendMessage($bot->chatId(), $bot->text());
}
```

- **Prós:** tempo real, sem carga de polling, sem conexão mantida aberta.
- **Contras:** exige um endpoint HTTPS público; callbacks registrados pelo Telegram.

### Configuração

```php
$bot->setWebhook('https://example.com/hook');
$bot->getWebhookInfo();
$bot->deleteWebhook();
```

> Nota: o formato moderno permite `secret_token`, `max_connections`, `allowed_updates` via o array `$options`.

## Long polling (sem necessidade de servidor público)

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

- **Prós:** funciona atrás de NAT, não precisa de TLS, simples.
- **Contras:** mantém um socket aberto; cada poll é uma ida e volta de rede.

**Nota sobre o timeout de long polling:** o timeout padrão de cURL do SDK é 30s, mas para `getUpdates` o timeout dado ao Telegram é utilizado e o timeout do cURL é elevado para `timeout + 5` para que a requisição HTTP não seja cortada antes de o Telegram responder.

### Tempo de vida / instância única

Execute exatamente um processo de polling por bot. Dois processos compartilhando o offset de `getUpdates` podem consumir updates um do outro silenciosamente (veja a depuração de *bot silencioso*). Use um gerenciador de processos (systemd / supervisor) para mantê-lo vivo, não múltiplos processos concorrentes.

## Como escolher

- Produtos públicos voltados ao público (Telegram webhook) → **webhook.
- Local/dev atrás de NAT → **polling.
- Hospedagem compartilhada que não consegue manter um processo aberto → polling com um script disparado por cron serve para baixa frequência, mas para um volume do Telegram um processo persistente é preferível.
