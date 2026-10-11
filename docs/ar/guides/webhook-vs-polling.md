<div dir="rtl">

# ويب هوك مقابل الاستطلاع الطويل

تدعم الـ SDK كلا وضعي التسليم — والاختيار يتخذه التطبيق.

## ويب هوك (يتطلب HTTPS)

```php
$bot = new Telegram($token);
$update = $bot->getInputData();      // decodes php://input

if ($bot->isMessage()) {
    $bot->sendMessage($bot->chatId(), $bot->text());
}
```

- **المزايا:** فورية (real-time)، بلا حمل استطلاع، وبلا اتصال مُبقًى مفتوحًا.
- **العيوب:** يتطلب نقطة نهاية HTTPS عامة؛ وتُسجَّل عمليات معاودة الاتصال (callbacks) لدى Telegram.

### الإعداد

```php
$bot->setWebhook('https://example.com/hook');
$bot->getWebhookInfo();
$bot->deleteWebhook();
```

> ملاحظة: الصيغة الحديثة تتيح `secret_token` و`max_connections` و`allowed_updates` عبر المصفوفة `$options`.

## الاستطلاع الطويل (لا يحتاج خادمًا عامًا)

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

- **المزايا:** يعمل خلف NAT، بلا حاجة إلى TLS، وبسيط.
- **العيوب:** يُبقي مقبسًا مفتوحًا؛ وكل دورة استطلاع هي رحلة ذهاب وعودة عبر الشبكة.

**ملاحظة حول مهلة الاستطلاع الطويل:** مهلة cURL الافتراضية في الـ SDK هي 30s، لكن في `getUpdates` تُستخدم المهلة المُمرَّرة إلى Telegram، وتُرفع مهلة cURL إلى `timeout + 5` حتى لا يُقطع طلب HTTP قبل أن يرد Telegram.

### العمر الافتراضي / نسخة واحدة

شغِّل عملية استطلاع واحدة بالضبط لكل بوت. عمليتان تتشاركان إزاحة `getUpdates` يمكن أن تستهلك كل منهما تحديثات الأخرى بصمت (راجع تنقيح مشكلة *البوت الصامت*). استخدم مدير عمليات (systemd / supervisor) لإبقائه حيًا، لا عمليات متزامنة متعددة.

## الاختيار

- المنتجات العامة الموجهة للجمهور (ويب هوك Telegram) → **ويب هوك.
- التشغيل المحلي/بيئة التطوير خلف NAT → **الاستطلاع الطويل.
- الاستضافة المشتركة التي لا تستطيع إبقاء عملية مفتوحة → الاستطلاع الطويل عبر سكربت يُطلَق بـ cron يكفي للترددات المنخفضة، أما لحجم Telegram فيُفضَّل عملية مستمرة.

</div>
