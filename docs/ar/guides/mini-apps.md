# التطبيقات المصغّرة — التحقق من `initData`

تستقبل واجهة التطبيق المصغّر من تلغرام سلسلة هوية **موقّعة** هي `Telegram.WebApp.initData` تُثبت أي مستخدم يفتح الصفحة. تحقّق من التوقيع على الخادم قبل تقديم أي بيانات للمستخدم.

- SDK: `telegramBotApiPhp\WebApp\InitData`

> **لا تثق أبداً بـ `initDataUnsafe`** — نفس الحقول بدون توقيع؛ حركة التطبيق المصغّر لا تمر عبر الويبهوك — المتصفح ينادي نطاقك مباشرة.

## الاستخدام في الواجهة الخلفية

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

## الواجهة البرمجية

| الطريقة | الوظيفة |
|---|---|
| `validate()` | النتيجة الكاملة: `ok`, `user`, `auth_date`, `start_param`, `fields`, `hash` |
| `valid()` | نتيجة منطقية |
| `user()` | مصفوفة المستخدم أو `null` |
| `build()` | توليد initData موقّعة (للاختبار فقط) |

الخيارات: `max_age` — أقصى عمر لـ `auth_date` بالثواني (افتراضي `86400`، `0` يعطّل الفحص). الأخطاء: `empty_init_data`, `bot_token_missing`, `malformed_init_data`, `hash_missing`, `bad_signature`, `auth_date_missing`, `auth_date_expired`.

## قائمة أمان

- تحقّق من كل طلب مهم على الخادم؛ أبقِ `max_age` قصيرة (`3600` أو أقل).
- المقارنة عبر `hash_equals` (زمن ثابت) — لا تستخدم `===`.
- لا تسجّل `initData` أو توكنات البوت.
- الخوارزمية: `secret = HMAC_SHA256("WebAppData", token)` ثم `HMAC_SHA256(secret, data_check_string)` — الدليل الكامل: [mini-apps.md](mini-apps.md).
