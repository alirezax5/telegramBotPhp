<div dir="rtl">

# کلاس اصلی Telegram

`telegramBotApiPhp\Telegram` تنها شیء ریشه است. آن را با یک توکن بسازید، هر متد API را فراخوانی کنید و داده‌های آپدیت را از طریق گترهای کمکی بخوانید.

## ساخت

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

`$curlTimeout` به کف 5 محدود می‌شود. برای long polling، `getUpdates(timeout:)` مهلت cURL را به `timeout+5` بالا می‌برد تا سوکت در میانه پالس قطع نشود.

## داده‌های آپدیت

سازنده `php://input` (وبهوک) را می‌خواند و آن را به‌صورت `stdClass` ذخیره می‌کند. داده را به‌صورت دستی با `setInputData()` عوض کنید و نمای‌های تایپ‌شده را از طریق گترها بخوانید:

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

گترهای آپدیت به‌ازای هر آپدیت **کش** می‌شوند (کش نمونه با `clearCache()` / `setInputData()` پاک می‌شود).

## گترهای کمکی (از `otherTrait`)

`text()`، `caption()`، `messageID()`، `fromId()`، `chatId()`، `firstName()`،
`lastName()`، `username()`، `languageCode()`، `isPremium()`، `chatType()`،
`msgType()`، `mediaType()`، `fileId()`، `mimeType()`، `fileSize()`، `isReply()`،
`replyToMessageId()`، `pathToUrl()`. این‌ها پیام‌ها، پیام‌های ویرایش‌شده، پست‌های
کانال، callback queryها و پیام‌های business را می‌پذیرند.

`msgType()` یکی از `PRIVATE|_TEXT|_MEDIA|_FORWARD` را برمی‌گرداند؛ `mediaType()` یکی از
`_PHOTO|_VIDEO|_AUDIO|_VOICE|...|_TEXT` را برمی‌گرداند.

## جابه‌جایی چندتوکنی

```php
$bot->switchToken('new-token');   // push
$bot->restoreToken();             // pop
$bot->clearTokenStack();
$bot->getTokenStackCount();
```

## HTTP / تاب‌آوری (Telegram::bot)

`bot(method, data, isUpload)` فراخوانی HTTP سطح پایین است. این متد:
- از یک هندل cURL واحد استفاده مجدد می‌کند (`close()` / `__destruct` آن را آزاد می‌کنند)؛
- برای خطاهای شبکه، 5xx و 429 تا سقف `maxRetries` با backoff نمایی دوباره تلاش می‌کند؛
- برای HTTP 429، پیش از تلاش مجدد `parameters.retry_after` را رعایت می‌کند؛
- در صورت موفقیت یک `stdClass` رمزگشایی‌شده برمی‌گرداند، یا پس از اتمام تلاش‌ها `['ok'=>false,'error'=>...,'http_code'=>...,'attempts'=>...]` را برمی‌گرداند.

`callRaw(method, data)` (عمومی، از تریت `method`) API را بدون پیچیدن نتیجه در یک شیء تایپ‌شده فراخوانی می‌کند — برای بازرسی خام مفید است.

## دسترسی مستقیم سطح پایین

- `getFileUrl($filePath)` — ساخت URL دانلود برای یک فایل از روی مسیر آن.
- `close()` — آزادسازی صریح هندل curl.

نقشه ماژول‌ها را در [overview.md](overview.md) و فهرست کامل متدها را در [methods.md](methods.md) ببینید.

</div>
