<div dir="rtl">

# ساختار پوشه‌ها

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

## چیدمان src/

| مسیر | کاربرد |
|------|---------|
| `Telegram.php` | کلاس اصلی — با یک توکن ساخته می‌شود؛ کلاینت HTTP، داده‌های آپدیت، کش، پشته توکن و پیکربندی retry را نگه می‌دارد. |
| `Traits/method.php` | تریت تجمیع‌گر که همه 7 تریت دامنه‌ای را `use` می‌کند + متدهای کمکی خصوصی مشترک `call()`/`prepareBotData()`/مدیا را تعریف می‌کند. |
| `Traits/{Updates,Messages,ChatAdministration,Stickers,PaymentsAndGames,Business,BotSettings}.php` | **186 متد API**، گروه‌بندی‌شده بر اساس دامنه API. |
| `Traits/{isUpdates,isChatTypes,isMedia}.php` | چکرهای بولی نوع آپدیت/چت/مدیا. |
| `Traits/otherTrait.php` | گترهای کمکی (`text()`، `chatId()`، `fileId()` و ...). |
| `Types/BaseType.php` | کلاس پایه انتزاعی برای همه تایپ‌ها — `__get`/`toArray` تنبل، `JsonSerializable`، iterable. |
| `Types/returned*.php` | پوشش‌های تایپ‌شده پاسخ (مثلاً `returnedMessage`، `returnedUser`). |
| `Types/*.php` | تایپ‌های موجودیت (Message، User، Chat، InlineKeyboardMarkup، InputRichMessage و ...). |

```
reason: the SDK keeps a deliberately flat profile — all behaviour on Telegram (via traits), all data as BaseType subclasses.

همچنین [methods.md](methods.md) و [telegram-class.md](telegram-class.md) را ببینید.

</div>
