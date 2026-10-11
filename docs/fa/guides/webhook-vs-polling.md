<div dir="rtl">

# وبهوک در برابر Long Polling

این SDK هر دو حالت دریافت آپدیت را پشتیبانی می‌کند — انتخاب در سطح برنامه با شماست.

## وبهوک (HTTPS لازم است)

```php
$bot = new Telegram($token);
$update = $bot->getInputData();      // decodes php://input

if ($bot->isMessage()) {
    $bot->sendMessage($bot->chatId(), $bot->text());
}
```

- **مزایا:** بلادرنگ، بدون بار polling، بدون اتصال بازِ نگه‌داشته‌شده.
- **معایب:** نیازمند یک اندپوینت HTTPS عمومی؛ callbackها توسط Telegram لاگ می‌شوند.

### راه‌اندازی

```php
$bot->setWebhook('https://example.com/hook');
$bot->getWebhookInfo();
$bot->deleteWebhook();
```

> نکته: قالب جدید، `secret_token`، `max_connections` و `allowed_updates` را از طریق آرایه `$options` مجاز می‌شمارد.

## Long polling (بدون نیاز به سرور عمومی)

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

- **مزایا:** پشت NAT کار می‌کند، TLS لازم ندارد، ساده.
- **معایب:** یک سوکت را باز نگه می‌دارد؛ هر پالس یک رفت‌وبرگشت شبکه‌ای است.

**نکته timeout پالس طولانی:** timeout پیش‌فرض cURL در SDK سی ثانیه است، اما برای `getUpdates` از timeout داده‌شده به Telegram استفاده می‌شود و timeout cURL به `timeout + 5` بالا برده می‌شود تا درخواست HTTP پیش از پاسخ Telegram قطع نشود.

### طول عمر / تک‌نمونه‌ای

برای هر ربات دقیقاً یک پروسه polling اجرا کنید. دو پروسه‌ای که آفست `getUpdates` را مشترک استفاده می‌کنند می‌توانند بی‌سروصدا آپدیت‌های یکدیگر را مصرف کنند (به عیب‌یابی *ربات بی‌صدا* نگاه کنید). برای زنده نگه‌داشتن آن از یک process manager (systemd / supervisor) استفاده کنید، نه چند پروسه همزمان.

## انتخاب

- محصولات عمومی و روبه‌مخاطب (وبهوک Telegram) → **وبهوک.
- محلی/توسعه پشت NAT → **polling.
- هاست اشتراکی که نمی‌تواند پروسه‌ای را باز نگه دارد → polling با اسکریپت cron-راه‌اندازی‌شده برای فرکانس پایین کافی است، اما برای حجم Telegram یک پروسه پایدار ترجیح داده می‌شود.

</div>
