# 多机器人指南

在一个 PHP 进程中运行两个或更多机器人 —— 用第二个机器人的
令牌检查频道成员身份，或者让机器人 #1 以机器人 #2 的身份发送消息。

支持两种独立的模式。两种模式都已用两个真实机器人进行了实测验证
（证据表见 [CHANGELOG.md](../../../CHANGELOG.md)）。

---

## 模式 1 —— 独立实例

每个 `Telegram` 对象拥有自己的令牌、cURL 句柄和更新缓存。实例之间
不共享任何东西，因此身份隔离由构造方式天然保证：

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

## 模式 2 —— 单实例上的令牌栈

一个 `Telegram` 实例可以临时*变成*另一个机器人，发送消息，然后再切换回来。
该栈是 LIFO 的：每次 `switchToken()` 都会压入当前令牌，`restoreToken()`
则将其弹出。

```php
// Scenario B (owner request): bot #1 sends AS bot #2, inside bot #1's process.
$bot1->switchToken($_ENV['BOT2_TOKEN']);
$bot1->sendMessage($chatId, 'این پیام توسط نمونهٔ ربات ۱، اما با هویت ربات ۲ ارسال شد');
$bot1->restoreToken();

// The same instance is bot #1 again:
$bot1->sendMessage($chatId, 'و این یکی دوباره از ربات ۱ است');
```

辅助方法：`getToken()`、`switchToken(string $token)`、`restoreToken()`、
`clearTokenStack()`、`getTokenStackCount()`。

> 当两个机器人都被持续使用时，请首选模式 1 —— 令牌栈是为
> 短促的、成对出现的切换而设计的。模式 2 保持单个 cURL 句柄（更少的套接字），
> 模式 1 则让身份永久分离。

## 原始调用

`callRaw(string $method, array $data = [])` 执行任意 Bot API 方法并返回
**完整解码的响应**（带有 `ok`、`result`、`description`、
`parameters.retry_after` 的 `stdClass`）—— 适用于新近添加的方法或诊断：

```php
$me    = $bot2->callRaw('getMe');          // $me->result->username
$probe = $bot2->callRaw('getChat', ['chat_id' => '@mychannel']);
```

## 框架集成（TelegramBase）

[TelegramBase 框架](https://github.com/alirezax5/telegramBase) 用一个 `BotManager` 注册表
包装了本库：

- `BOT_EXTRA_BOTS="second:<token2>,third:<token3>"`（环境变量）在启动时注册命名机器人；
- 插件通过 `BotManager::getInstance()->get('second')` 获取它们；
- 必须先用 `has('name')` 检查 —— 对未知名称调用 `get()` 会静默回退到
  **主**机器人，从而以错误的身份执行调用；
- 参见框架仓库中的 `docs/en/multi-bot.md`。

## 一个 webhook 文件，多个机器人（secret_token 路由）

你可以用**一个 webhook 文件服务任意数量的机器人** —— 无需额外的文件夹，机器人令牌也永远不会出现在 URL 中：

1. 给**每个机器人一个专属的随机 secret**（`[A-Za-z0-9_-]`，32+ 个字符）。
2. 为每个机器人注册**同一个 URL**，各配一个自己的 secret：
   `setWebhook?url=https://example.com/hook.php&secret_token=<this-bots-secret>`
3. Telegram 在每条更新中都会通过请求头 `X-Telegram-Bot-Api-Secret-Token` 把 secret 原样带回。
4. 在 `hook.php` 中读取该请求头，在注册表（`secret → token`）中查找该 secret，然后构建对应的 `Telegram` 实例（模式 1），并以该身份处理更新。

```php
// hook.php —— 整个路由器只需几行
$registry = [
    'secret-A...' => $_ENV['BOT1_TOKEN'],
    'secret-B...' => $_ENV['BOT2_TOKEN'],
];
$secret = $_SERVER['HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN'] ?? '';
if (!isset($registry[$secret])) { http_response_code(403); exit; }

$bot = new Telegram($registry[$secret]);           // 该机器人自己的身份
$update = json_decode(file_get_contents('php://input'), true);
// ... 用 $bot 处理 $update ...
```

这个 secret 同时兼任真实性校验（不带它的请求并非来自 Telegram —— 返回 `403`）。已于 2026-10-11 实测验证：两个真实机器人、一个文件、7/7 次投递，每一次身份都正确。

令牌存储选项，简版：固定的机器人集合 → `.env`；运行时新增的机器人 → 数据库表，令牌列**静态加密**（并对查找做缓存）；用户创建的子机器人 → 托管机器人（Managed Bots），令牌通过 `getManagedBotToken($user_id)` 从 Telegram 实时获取，绝不写入磁盘。

## 陷阱

- **`get()` 回退**：调用 `get('unknown-name')` 会返回主机器人（并记录一条警告日志）
  而不是抛出异常 —— 务必先用 `has()` 检查。
- **令牌栈是按实例隔离的**：在 `$bot1` 上切换令牌不会影响 `$bot2`。
- **不配对的恢复**：如果在异常路径上调用了 `switchToken()` 却没有匹配的 `restoreToken()`，
  实例会保留借来的身份。请使用 try/finally：
  ```php
  $bot1->switchToken($t2);
  try {
      $bot1->sendMessage($chatId, 'as bot #2');
  } finally {
      $bot1->restoreToken();
  }
  ```
- **JSON 字段内的文件上传**：`stickers`、`media` 等参数的本地路径会被自动转换为
  `CURLFile`（v3.3.0+）—— 但只发生在 JSON 编码之前，因此对这些参数务必传入 PHP 数组
  （而不是预先编码好的 JSON 字符串）。

## 实测验证（2026-10-11）

两个真实机器人（`@emojiCustom_bot` 为 #1，`@instaroonxbot` 为 #2），一个 PHP 进程：

| 步骤 | 结果 |
|---|---|
| 身份：通过两个实例调用 `getMe` | ✔ 两个用户名 |
| 隔离：机器人 #2 的调用从未触及机器人 #1 的令牌 | ✔ |
| 交叉发送（模式 2）：机器人 #1 以机器人 #2 的身份发送 → 用户聊天 | ✔ 239 ms |
| 成员身份（模式 1）：通过机器人 #2 调用 `getChatMember` | ✔ `status=member`，13 ms |
| 主实例上的令牌栈往返 | ✔ 切换 → @instaroonxbot，恢复 → @emojiCustom_bot |
| 完整测试套件 | ✔ 5/5，总计 393 ms |
| secret_token webhook 路由：两个机器人 → 一个文件，真实 `/start` + 真实按钮点击 | ✔ 7/7，每次身份都正确 |
