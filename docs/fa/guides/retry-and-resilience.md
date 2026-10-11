<div dir="rtl">

# Retry و تاب‌آوری

این SDK یک لایه کوچک و داخلی برای قابلیت اطمینان HTTP در `Telegram::bot()` دارد.

## سیاست retry

- **تلاش‌ها:** حداکثر `maxRetries` تلاش مجدد (پیش‌فرض **3**) پس از درخواست اول.
- **محرک‌های تلاش مجدد:** خطای cURL/شبکه، خطای سرور `5xx` و `429` (محدودیت نرخ).
- **Backoff:** نمایی — `retryDelayMs * 2^(attempt-1)` (تاخیر اول پیش‌فرض 500ms → 1s → 2s).
- **رعایت 429:** اگر پاسخ API `parameters.retry_after` را همراه داشته باشد، کلاینت دقیقاً به همان تعداد **ثانیه** پیش از تلاش مجدد صبر می‌کند (به‌جای حدس نمایی). این کار از فشار بیش از حد بر محدودکننده نرخ جلوگیری می‌کند.

## رفتار cURL

- یک هندل cURL واحد به‌صورت تنبل ساخته می‌شود و در فراخوانی‌ها **استفاده مجدد** می‌شود (بازیابی اتصال در long polling). آن را با `close()` یا هنگام destruct آزاد کنید.
- `CURLOPT_TIMEOUT` به‌طور پیش‌فرض 30s است (`$curlTimeout` سازنده). برای `getUpdates` با long-poll و `timeout` صریح، timeout سوکت به `timeout + 5` بالا برده می‌شود تا پاسخ کند long-poll قطع نشود.
- تأیید SSL روشن است (`CURLOPT_SSL_VERIFYPEER => true`).

## شکل خروجی در خطا

وقتی تلاش‌ها تمام شوند، `bot()` یک `stdClass` برمی‌گرداند:

```php
(object)[
    'ok'       => false,
    'error'    => 'curl error message' ?: 'API Error after N attempts',
    'http_code'=> 200|429|5xx|0,
    'attempts' => N,
];
```

`callRaw()` همین شیء خام را برمی‌گرداند؛ متدهای تایپ‌شده فیلد `result` را در صورت وجود در خود می‌پیچند.

## در عمل

```php
$bot = new Telegram($token, maxRetries: 5, retryDelayMs: 300, curlTimeout: 60);

$res = $bot->sendMessage($chatId, 'Hi');
if (!($res->ok ?? false)) {
    // handle API error via $res->error / $res->http_code
}
```

</div>
