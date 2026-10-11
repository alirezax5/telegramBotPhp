<div dir="rtl">

# دليل تعدد البوتات

تشغيل بوتين أو أكثر داخل عملية PHP واحدة — التحقق من عضوية القناة باستخدام
توكن البوت الثاني، أو السماح للبوت رقم 1 بإرسال الرسائل بصفت البوت رقم 2.

يُدعم نمطان مستقلان. وقد جرى التحقق من كليهما مباشرةً (live) باستخدام بوتين حقيقيين
(راجع [CHANGELOG.md](../../../CHANGELOG.md) لجدول الأدلة).

---

## النمط 1 — نسخ مستقلة

كل كائن `Telegram` يملك توكنه الخاص ومقبض cURL الخاص وذاكرة تحديثات الخاصة. لا يُشارَك
أي شيء بين النسخ، ولذلك عزل الهوية مضمون بالتصميم نفسه:

```php
use telegramBotApiPhp\Telegram;

$bot1 = new Telegram($_ENV['BOT1_TOKEN']);
$bot2 = new Telegram($_ENV['BOT2_TOKEN']);

// Scenario A (owner request): membership check executed by bot #2's token,
// from inside bot #1's process.
$member = $bot2->getChatMember('@mychannel', $userId);
if (($member->result->status ?? '') === 'member') {
    // user is in the channel — checked by bot #2
}

$bot1->sendMessage($chatId, 'این پاسخ از ربات ۱ است');
$bot2->sendMessage($chatId, 'این پیام از ربات ۲ است');
```

## النمط 2 — كومة التوكنات على نسخة واحدة

يمكن لنسخة `Telegram` واحدة أن *تتحول* مؤقتًا إلى بوت آخر، وترسل، ثم تعود إلى حالتها.
الكومة تعمل بنظام LIFO: كل `switchToken()` تدفع التوكن الحالي إلى الكومة، و`restoreToken()`
تسحبه منها.

```php
// Scenario B (owner request): bot #1 sends AS bot #2, inside bot #1's process.
$bot1->switchToken($_ENV['BOT2_TOKEN']);
$bot1->sendMessage($chatId, 'این پیام توسط نمونهٔ ربات ۱، اما با هویت ربات ۲ ارسال شد');
$bot1->restoreToken();

// The same instance is bot #1 again:
$bot1->sendMessage($chatId, 'و این یکی دوباره از ربات ۱ است');
```

الدوال المساعدة: `getToken()`، `switchToken(string $token)`، `restoreToken()`،
`clearTokenStack()`، `getTokenStackCount()`.

> فضِّل النمط 1 عندما يُستخدَم كلا البوتين باستمرار — فالكومة مصمَّمة لرحلات قصيرة محصورة.
> النمط 2 يحتفظ بمقبض cURL واحد (مقابس أقل)، والنمط 1 يُبقي الهويات منفصلة بشكل دائم.

## الاستدعاءات الخام

الدالة `callRaw(string $method, array $data = [])` تنفّذ أي أسلوب من أساليب Bot API وتُعيد
**الاستجابة الكاملة المفكوكة الترميز** (كائن `stdClass` يحوي `ok` و`result` و`description`
و`parameters.retry_after`) — وهي مفيدة للأساليب المضافة حديثًا أو لأغراض التشخيص:

```php
$me    = $bot2->callRaw('getMe');          // $me->result->username
$probe = $bot2->callRaw('getChat', ['chat_id' => '@mychannel']);
```

## التكامل مع إطار العمل (TelegramBase)

إطار العمل [TelegramBase](https://github.com/alirezax5/telegramBase) يغلّف هذه
المكتبة بسجلّ `BotManager`:

- `BOT_EXTRA_BOTS="second:<token2>,third:<token3>"` (متغير بيئة) يسجّل البوتات المسمّاة عند الإقلاع؛
- تجلبها الإضافات (plugins) عبر `BotManager::getInstance()->get('second')`؛
- يجب فحص `has('name')` أولًا — فـ`get()` باسم غير معروف تعود بصمت إلى البوت **الرئيسي**،
  ما سيؤدي إلى تنفيذ الاستدعاء بهوية خاطئة؛
- راجع `docs/en/multi-bot.md` في مستودع إطار العمل.

## ملف ويب هوك واحد، وبوتات كثيرة (توجيه `secret_token`)

يمكنك خدمة **أي عدد من البوتات من ملف ويب هوك واحد** — بلا مجلدات إضافية،
وتوكنات البوتات لا تظهر في عناوين URL أبدًا:

1. امنح **كل بوت سره العشوائي الخاص** (`[A-Za-z0-9_-]`، 32+ محرفًا).
2. سجِّل **العنوان نفسه** لكل بوت، وكل بوت بسرّه الخاص:
   `setWebhook?url=https://example.com/hook.php&secret_token=<this-bots-secret>`
3. يردّد Telegram السر مع كل تحديث في الترويسة
   `X-Telegram-Bot-Api-Secret-Token`.
4. في `hook.php`، اقرأ الترويسة، وابحث عن السر في سجلّ
   (`secret → token`)، ثم أنشئ نسخة `Telegram` المطابقة
   (النمط 1) وعالج التحديث تحت تلك الهوية.

```php
// hook.php — الموجِّه كله في بضعة أسطر
$registry = [
    'secret-A...' => $_ENV['BOT1_TOKEN'],
    'secret-B...' => $_ENV['BOT2_TOKEN'],
];
$secret = $_SERVER['HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN'] ?? '';
if (!isset($registry[$secret])) { http_response_code(403); exit; }

$bot = new Telegram($registry[$secret]);           // هوية ذلك البوت
$update = json_decode(file_get_contents('php://input'), true);
// ... عالِج $update باستخدام $bot ...
```

السر يعمل في الوقت نفسه كفحص أصالة (الطلبات التي تصل بلا سر ليست من
Telegram — أجب بـ `403`). تحقّق مباشر في 2026-10-11: بوتان حقيقيان، ملف واحد،
7/7 عمليات تسليم بالهوية الصحيحة في كل مرة.

خيارات تخزين التوكنات، نسخة موجزة: مجموعة بوتات ثابتة → `.env`؛ بوتات تُضاف في وقت التشغيل → جدول في قاعدة البيانات مع عمود توكن **مشفَّر في حالة السكون (at rest)** (خبِّئ عملية البحث)؛ الأبناء الذين ينشئهم المستخدمون → البوتات المُدارة (Managed Bots)، يُجلب التوكن مباشرةً من Telegram عبر `getManagedBotToken($user_id)` ولا يُكتب إلى القرص أبدًا.

## المزالق

- **رجوع `get()` التلقائي**: استدعاء `get('unknown-name')` يُعيد البوت الرئيسي (مع تسجيل
  تحذير) بدلًا من رمي استثناء — احمِ استدعاءاتك دائمًا بفحص `has()`.
- **كومة التوكنات خاصة بكل نسخة على حدة**: تبديل التوكنات على `$bot1` لا يؤثر في `$bot2`.
- **استعادة غير متوازنة**: إذا استدعيت `switchToken()` دون `restoreToken()` مقابلة لها
  في مسار استثناء، فإن النسخة تحتفظ بالهوية المستعارة. استخدم try/finally:
  ```php
  $bot1->switchToken($t2);
  try {
      $bot1->sendMessage($chatId, 'as bot #2');
  } finally {
      $bot1->restoreToken();
  }
  ```
- **رفع الملفات داخل حقول JSON**: المسارات المحلية للمعاملات `stickers` و`media` وغيرها
  تُحوَّل تلقائيًا إلى `CURLFile` (منذ v3.3.0+) — لكن ذلك يحدث قبل ترميز JSON فقط، لذا
  مرِّر دائمًا مصفوفات PHP (وليس سلاسل JSON مُرمَّزة مسبقًا) لهذه المعاملات.

## التحقق المباشر (2026-10-11)

بوتان حقيقيان (`@emojiCustom_bot` بوصفه رقم 1، و`@instaroonxbot` بوصفه رقم 2)، وعملية PHP واحدة:

| الخطوة | النتيجة |
|---|---|
| الهوية: `getMe` عبر النسختين | ✔ اسمان مستخدمان |
| العزل: استدعاءات البوت رقم 2 لم تلمس توكن البوت رقم 1 مطلقًا | ✔ |
| الإرسال المتقاطع (النمط 2): البوت رقم 1 يرسل بصفت البوت رقم 2 → محادثة المستخدم | ✔ 239 ms |
| العضوية (النمط 1): `getChatMember` عبر البوت رقم 2 | ✔ `status=member`، 13 ms |
| ذهاب وإياب كومة التوكنات على النسخة الرئيسية | ✔ تبديل → @instaroonxbot، استعادة → @emojiCustom_bot |
| حزمة الاختبارات الكاملة | ✔ 5/5، 393 ms إجمالًا |
| توجيه الويب هوك عبر secret_token: كلا البوتين → ملف واحد، `/start` حقيقي + ضغطات أزرار حقيقية | ✔ 7/7، الهوية الصحيحة في كل مرة |

</div>
