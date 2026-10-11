<div dir="rtl">

# نظام الأنواع

كل استجابة JSON قادمة من Bot API تُفكّ ترميزها إلى `stdClass`، ثم تُغلَّف في صنف فرعي من `BaseType` (تغليف كسول عبر الخاصية السحرية `__get`).

## الصنف BaseType

`telegramBotApiPhp\Types\BaseType` (مجرّد) ينفّذ:

- `__get(string $name): mixed` — يقرأ من المصفوفة الأساسية؛ ويُعيد `null` للمفاتيح المفقودة.
- `__isset(string $name): bool`
- `getIterator(): \Traversable`
- `toArray(): array` — تكراري: الأصناف `BaseType` المتداخلة ومصفوفات `BaseType` تُحوَّل كذلك.
- `jsonSerialize(): array` — ليعمل `json_encode($type)`.
- `static create(array|object $data): static` — دالة إنشاء (factory) تستخدمها جميع أساليب الـ API.

تصل البيانات إما كـ`stdClass` (يحوّلها المُنشئ عبر `get_object_vars`) أو كمصفوفة، أو كـ`BaseType` آخر.

## أغلفة الاستجابات returned*

كل أسلوب من أساليب الـ API يُعيد نوع **استجابة** مثل:

| صنف الاستجابة | حمولة النتيجة |
|----------------|----------------|
| `returned`               | `bool`‏ (ok) |
| `returnedMessage`        | `Message` |
| `returnedUser`           | `User` |
| `returnedChat`           | `ChatFullInfo` |
| `returnedChatMember`     | `ChatMember` |
| `returnedFile`           | `File` |
| `returnedBotShortDescription` | `BotShortDescription` |
| `returnedArrayOfMessageId`، `returnedArrayOfChatMember`، ... | مصفوفات من الكيانات |
| `returnedInt`، `returnedString` | قيمة عدّية |

هي أغلفة رقيقة ممنوحة بالأنواع: `ok`، `error_code`، `description` + `result`.

## أنواع الكيانات

Message، User، Chat، ChatMember، StickerSet، Poll، GameHighScore، InlineQueryResult، InputMedia، InputRichMessage وغيرها — 199 صنفًا في المجموع، وكلها تمتد من `BaseType`.

## لماذا خصائص سحرية بدلًا من خصائص عامة ممنوحة بالأنواع؟

- صيانة صفرية: حقول الـ API الجديدة تظهر تلقائيًا (توافق مع الإصدارات القادمة).
- تظل كائنات التحديث/الاستجابة الخام هي المصدر الوحيد للحقيقة.
- المقايضة: لا يوجد إكمال تلقائي (autocomplete) من الـ IDE للحقول (راجع أفكار إعادة الهيكلة في [methods.md](methods.md) / خارطة طريق المشروع).

للحصول على البيانات الخام من جديد: `$type->toArray()` أو `json_encode($type)`.

</div>
