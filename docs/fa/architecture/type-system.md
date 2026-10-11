<div dir="rtl">

# سیستم تایپ

هر پاسخ JSON از Bot API به `stdClass` رمزگشایی می‌شود و سپس در یک زیرکلاس `BaseType` (تنبل، با `__get` جادویی) پیچیده می‌شود.

## BaseType

`telegramBotApiPhp\Types\BaseType` (انتزاعی) این‌ها را پیاده‌سازی می‌کند:

- `__get(string $name): mixed` — از آرایه زیرین می‌خواند؛ برای کلیدهای ناموجود `null` برمی‌گرداند.
- `__isset(string $name): bool`
- `getIterator(): \Traversable`
- `toArray(): array` — بازگشتی: `BaseType`های تودرتو و آرایه‌های `BaseType` تبدیل می‌شوند.
- `jsonSerialize(): array` — تا `json_encode($type)` کار کند.
- `static create(array|object $data): static` — کارخانه‌ای که همه متدهای API استفاده می‌کنند.

داده یا به‌صورت `stdClass` می‌رسد (سازنده از طریق `get_object_vars` تبدیلش می‌کند) یا به‌صورت آرایه، یا یک `BaseType` دیگر.

## پوشش‌های پاسخ returned*

هر متد API یک تایپ **پاسخ** مانند موارد زیر برمی‌گرداند:

| کلاس پاسخ | محتوای نتیجه |
|----------------|----------------|
| `returned`               | `bool` (ok) |
| `returnedMessage`        | `Message` |
| `returnedUser`           | `User` |
| `returnedChat`           | `ChatFullInfo` |
| `returnedChatMember`     | `ChatMember` |
| `returnedFile`           | `File` |
| `returnedBotShortDescription` | `BotShortDescription` |
| `returnedArrayOfMessageId`, `returnedArrayOfChatMember`, ... | آرایه‌ای از موجودیت‌ها |
| `returnedInt`, `returnedString` | اسکالر |

این‌ها پوشش‌های تایپ‌شده نازکی هستند: `ok`، `error_code`، `description` + `result`.

## تایپ‌های موجودیت

Message، User، Chat، ChatMember، StickerSet، Poll، GameHighScore، InlineQueryResult، InputMedia، InputRichMessage و غیره — در مجموع 199 کلاس، که همگی از `BaseType` مشتق می‌شوند.

## چرا پراپرتی‌های جادویی به‌جای پراپرتی‌های عمومی تایپ‌دار؟

- نگهداری صفر: فیلدهای جدید API خودکار ظاهر می‌شوند (سازگار با آینده).
- شیءهای خام آپدیت/پاسخ منبع یگانه حقیقت باقی می‌مانند.
- بهای معامله: بدون تکمیل خودکار IDE برای فیلدها (ایده‌های بازآرایی را در [methods.md](methods.md) / نقشه راه پروژه ببینید).

برای برگرداندن داده خام: `$type->toArray()` یا `json_encode($type)`.

</div>
