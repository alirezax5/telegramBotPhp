<div dir="rtl">

# بنية المجلدات

```
telegramBotPhp/
├── README.md                  # Quick start + install + index
├── composer.json              # PSR-4: telegramBotApiPhp\ => src/
├── src/
│   ├── Telegram.php           # Core class (root object)
│   ├── Traits/                # All behaviour is mixed in here
│   └── Types/                 # Response & entity classes
└── docs/
    ├── architecture/          # Design docs (this tree)
    └── guides/                # How-to guides
```

## البنية الداخلية لـ src/

| المسار | الغرض |
|------|---------|
| `Telegram.php` | الصنف الأساسي — يُنشأ بتمرير توكن؛ ويحتفظ بعميل HTTP وببيانات التحديث وبالذاكرة المؤقتة وبكومة التوكنات وبإعدادات إعادة المحاولة. |
| `Traits/method.php` | trait تجميعي يُجري `use` لجميع traits المجالات السبعة + يعرّف الدوال الخاصة المشتركة `call()`/`prepareBotData()`/ومساعِدات الوسائط. |
| `Traits/{Updates,Messages,ChatAdministration,Stickers,PaymentsAndGames,Business,BotSettings}.php` | **186 أسلوبًا من أساليب الـ API**، مجمّعة حسب مجال الـ API. |
| `Traits/{isUpdates,isChatTypes,isMedia}.php` | متحققات منطقية (Boolean) لأنواع التحديث/المحادثة/الوسائط. |
| `Traits/otherTrait.php` | دوال وصول ملائمة (`text()`، `chatId()`، `fileId()`، ...). |
| `Types/BaseType.php` | الصنف الأساسي المجرّد لجميع الأنواع — `__get`/`toArray` كسولة، `JsonSerializable`، وقابل للتكرار. |
| `Types/returned*.php` | أغلفة استجابات ممنوحة بالأنواع (مثل `returnedMessage` و`returnedUser`). |
| `Types/*.php` | أنواع الكيانات (Message، User، Chat، InlineKeyboardMarkup، InputRichMessage، ...). |

```
السبب: يحافظ الـ SDK على ملف مسطّح متعمَّد — كل السلوك على Telegram (عبر traits)، وكل البيانات كأصناف فرعية من BaseType.

راجع أيضًا [methods.md](methods.md) و[telegram-class.md](telegram-class.md).

</div>
