# telegramBotPhp

[English](README.md) · [فارسی](README.fa.md) · **中文** · [Русский](README.ru.md) · [Français](README.fr.md) · [Português](README.pt.md) · [العربية](README.ar.md)

轻量级的 PHP 8.1+ **Telegram Bot API** 封装库 —— 零运行时依赖，完整覆盖当前每一个 API 方法（186 个 Bot 方法）和每一个响应/实体类型（199 个类型）。

当前版本：**3.4.0** —— 参见 [CHANGELOG.md](CHANGELOG.md)（修复了 3.2.1 中损坏的 `getChatMember()`，补全了嵌套参数的 JSON 序列化，剔除 null 值，修复了 cURL 超时泄漏；多机器人流程已用两个真实机器人实测验证）。

## 环境要求

- PHP >= 8.1
- cURL 扩展（`ext-curl`）
- JSON 扩展（`ext-json`）
- Composer

## 安装

```bash
composer require alirezax5/telegram-bot-php
```

## 快速上手

```php
require 'vendor/autoload.php';

use telegramBotApiPhp\Telegram;

// Long polling
$bot = new Telegram($_ENV['TELEGRAM_BOT_TOKEN']);

$updates = $bot->getUpdates(0, 100, 50);       // offset, limit, long-poll timeout (s)
foreach ($updates->result as $u) {
    $bot->setInputData($u);
    $chatId = $bot->chatId();
    $text   = $bot->text();

    if ($text === '/start') {
        $bot->sendMessage($chatId, 'Welcome!');
    }
}

// Webhook mode
$update = $bot->getInputData();                   // decodes php://input
if ($bot->isMessage()) {
    $bot->sendMessage($chatId, $bot->text());
}
```

## 多机器人（一个进程运行两个机器人）

```php
// Pattern 1 — independent instances (e.g. membership check via bot #2)
$bot2 = new Telegram($_ENV['BOT2_TOKEN']);
$member = $bot2->getChatMember('@mychannel', $userId);
$status = $member->result->status ?? 'left';      // member | administrator | creator | left | kicked

// Pattern 2 — token stack: bot #1 sends AS bot #2
$bot->switchToken($_ENV['BOT2_TOKEN']);
$bot->sendMessage($chatId, 'Sent as bot #2, from the bot #1 process');
$bot->restoreToken();

// Raw API access (full stdClass response)
$me = $bot->callRaw('getMe');
```

完整指南：[docs/guides/multi-bot.md](docs/zh/guides/multi-bot.md)。

## Mini App `initData` 校验

小程序前端会从 Telegram 收到**已签名**的身份字符串(`Telegram.WebApp.initData`)。在返回用户数据之前必须在服务端校验它 —— `telegramBotApiPhp\WebApp\InitData` 以恒定时间比较实现了官方 HMAC-SHA256 方案:

```php
use telegramBotApiPhp\WebApp\InitData;

$res = InitData::validate($_POST['initData'] ?? '', $botToken, ['max_age' => 3600]);
if (!$res['ok']) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => $res['error']]);
    exit;
}

$me         = $res['user'];         // ['id' => 555000111, 'first_name' => 'Ali', ...]
$startParam = $res['start_param'];  // 来自 ?startapp=
```

辅助方法:`valid()`、`user()` 与 `build()`(仅用于测试的签名 initData 生成器)。完整指南:[docs/guides/mini-apps.md](docs/guides/mini-apps.md)。

## 架构

```
src/
├── Telegram.php          # Core class — HTTP client, update parser, token stack, caching, retry
├── Traits/
│   ├── Updates.php            # polling + webhook methods (getUpdates, setWebhook, getMe, ...)
│   ├── Messages.php          # 45 messaging methods (send*, edit*, ephemeral, rich)
│   ├── ChatAdministration.php# 51 chat/admin/forum methods
│   ├── Stickers.php          # 16 sticker-set methods
│   ├── PaymentsAndGames.php  # 11 payments/stars/games methods
│   ├── Business.php          # 36 business/managed-bot/story/inline/user-verify methods
│   ├── BotSettings.php       # 20 bot-profile/commands/menu methods
│   ├── isUpdates.php         # Boolean checkers for update types (23)
│   ├── isChatTypes.php       # Boolean checkers for chat types
│   ├── isMedia.php           # Boolean checkers for media types
│   └── otherTrait.php        # Convenience getters (messageID, text, chatId, mediaType, ...)
└── Types/                    # 199 typed response wrappers (BaseType subclass)
```

`Telegram` 通过 `method` 聚合器 trait 引入所有领域 trait。
所有 API 方法都返回由 `BaseType::create()` 构建的类型化 `returned*`（响应）对象。

## 许可证

MIT

## 文档
- [architecture/overview.md](docs/zh/architecture/overview.md) — 完整架构
- [architecture/folder-structure.md](docs/zh/architecture/folder-structure.md)
- [architecture/methods.md](docs/zh/architecture/methods.md) — 按 trait 分组的 186 个方法
- [architecture/telegram-class.md](docs/zh/architecture/telegram-class.md) — 核心类参考
- [architecture/type-system.md](docs/zh/architecture/type-system.md) — 类型系统与 returned*
- [guides/webhook-vs-polling.md](docs/zh/guides/webhook-vs-polling.md)
- [guides/retry-and-resilience.md](docs/zh/guides/retry-and-resilience.md) — 重试策略
- [guides/multi-bot.md](docs/zh/guides/multi-bot.md) — 一个进程运行两个机器人（令牌栈、原始调用）
- [CHANGELOG.md](CHANGELOG.md) — 发布历史
- [README.fa.md](README.fa.md) — 波斯语文档（RTL）
