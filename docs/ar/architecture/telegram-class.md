<div dir="rtl">

# الصنف الأساسي Telegram

`telegramBotApiPhp\Telegram` هو كائن الجذر الوحيد. أنشئه بتمرير توكن، واستدعِ أي أسلوب من أساليب الـ API، واقرأ بيانات التحديث من خلال دوال وصول ملائمة.

## الإنشاء

```php
new Telegram(
    string $token,
    string $apiUrl = 'https://api.telegram.org',
    string $fileUrlTemplate = '{url}/file/bot{token}/{file_path}',
    int    $maxRetries = 3,
    int    $retryDelayMs = 500,
    int    $curlTimeout = 30
)
```

تُقيَّد قيمة `$curlTimeout` بحدٍ أدنى قدره 5. في وضع الاستطلاع الطويل، يرفع `getUpdates(timeout:)` مهلة cURL إلى `timeout+5` حتى لا يُقطع الاتصال في منتصف عملية الاستطلاع.

## بيانات التحديث

يقرأ المُنشئ `php://input` (ويب هوك) ويخزّنه كـ`stdClass`. بدّل البيانات يدويًا عبر `setInputData()`، واقرأ المناظر الممنوحة بالأنواع من خلال دوال الوصول:

```php
$bot->message();            // ?Message
$bot->callbackQuery();      // ?CallbackQuery
$bot->editedMessage();      // ?Message
$bot->channelPost();        // ?Message
$bot->poll();               // ?Poll
$bot->chatMember();         // ?ChatMemberUpdated
// ... 20+ typed getters
$bot->checkUpdateExists('message');   // bool
$bot->getUpdateId();                  // int
```

دوال وصول التحديث تكون **مخزّنة مؤقتًا** لكل تحديث (تُمسح ذاكرة النسخة عبر `clearCache()` / `setInputData()`).

## دوال الوصول الملائمة (من `otherTrait`)

`text()`، `caption()`، `messageID()`، `fromId()`، `chatId()`، `firstName()`،
`lastName()`، `username()`، `languageCode()`، `isPremium()`، `chatType()`،
`msgType()`، `mediaType()`، `fileId()`، `mimeType()`، `fileSize()`، `isReply()`،
`replyToMessageId()`، `pathToUrl()`. تقبل هذه الدوال الرسائل والرسائل المعدَّلة ومنشورات
القنوات واستعلامات معاودة الاتصال (callback queries) ورسائل الأعمال (business messages).

تُعيد `msgType()` إحدى القيم `PRIVATE|_TEXT|_MEDIA|_FORWARD`؛ وتُعيد `mediaType()`
إحدى القيم `_PHOTO|_VIDEO|_AUDIO|_VOICE|...|_TEXT`.

## التبديل بين توكنات متعددة

```php
$bot->switchToken('new-token');   // push
$bot->restoreToken();             // pop
$bot->clearTokenStack();
$bot->getTokenStackCount();
```

## HTTP / المرونة (Telegram::bot)

الدالة `bot(method, data, isUpload)` هي الاستدعاء HTTP منخفض المستوى. وهي:
- تعيد استخدام مقبض cURL واحد (`close()` / `__destruct` يحرّرانه)؛
- تعيد المحاولة حتى `maxRetries` مرةً بتراجع أُسّي عند أخطاء الشبكة و`5xx` و`429`؛
- عند HTTP 429 تراعي `parameters.retry_after` قبل إعادة المحاولة؛
- تُعيد كائن `stdClass` مفكوك الترميز عند النجاح، أو `['ok'=>false,'error'=>...,'http_code'=>...,'attempts'=>...]` بعد استنفاد المحاولات.

الدالة `callRaw(method, data)` (عامة، من trait‏ `method`) تستدعي الـ API دون تغليف النتيجة في كائن ممنوح بالأنواع — وهي مفيدة للفحص الخام المباشر.

## الوصول المباشر منخفض المستوى

- `getFileUrl($filePath)` — بناء رابط تنزيل لملفٍ انطلاقًا من مساره.
- `close()` — تحرير مقبض cURL صراحةً.

راجع [overview.md](overview.md) لخريطة الوحدات، و[methods.md](methods.md) لقائمة الأساليب الكاملة.

</div>
