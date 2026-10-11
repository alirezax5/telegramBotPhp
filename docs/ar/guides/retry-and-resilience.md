<div dir="rtl">

# إعادة المحاولة والمرونة

تأتي الـ SDK مع طبقة موثوقية HTTP صغيرة مدمجة داخل `Telegram::bot()`.

## سياسة إعادة المحاولة

- **المحاولات:** حتى `maxRetries` إعادة محاولة (الافتراضي **3**) بعد الطلب الأول.
- **محفّزات إعادة المحاولة:** خطأ cURL/شبكة، وخطأ خادم `5xx`، و`429` (تجاوز حد المعدل).
- **التراجع (backoff):** أُسّي — `retryDelayMs * 2^(attempt-1)` (التأخير الأول الافتراضي 500ms → 1s → 2s).
- **مراعاة 429:** إذا كانت استجابة الـ API تحمل `parameters.retry_after`، فإن العميل ينتظر ذلك العدد بالضبط من **الثواني** قبل إعادة المحاولة (بدلًا من التخمين الأُسّي). هذا يجنّب الضغط المستمر على مُحدِّد المعدل.

## سلوك cURL

- يُنشأ مقبض cURL واحد بشكل كسول ويُعاد **استخدامه** عبر الاستدعاءات (إعادة استخدام الاتصال أثناء الاستطلاع الطويل). حرِّره عبر `close()` أو عند التدمير.
- `CURLOPT_TIMEOUT` افتراضيًا 30s (عبر `$curlTimeout` في المُنشئ). في `getUpdates` للاستطلاع الطويل مع `timeout` صريح، تُرفع مهلة المقبس إلى `timeout + 5` حتى لا تُقطع استجابة الاستطلاع الطويل البطيئة.
- التحقق من SSL مفعَّل (`CURLOPT_SSL_VERIFYPEER => true`).

## شكل القيمة المُعادة عند الفشل

عند استنفاد المحاولات، تُعيد `bot()` كائن `stdClass` بالشكل:

```php
(object)[
    'ok'       => false,
    'error'    => 'curl error message' ?: 'API Error after N attempts',
    'http_code'=> 200|429|5xx|0,
    'attempts' => N,
];
```

تُعيد `callRaw()` هذا الكائن الخام؛ أما الأساليب الممنوحة بالأنواع فتغلّف حقل `result` إن وُجد.

## عمليًا

```php
$bot = new Telegram($token, maxRetries: 5, retryDelayMs: 300, curlTimeout: 60);

$res = $bot->sendMessage($chatId, 'Hi');
if (!($res->ok ?? false)) {
    // handle API error via $res->error / $res->http_code
}
```

</div>
