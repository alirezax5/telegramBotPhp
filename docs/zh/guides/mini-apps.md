# Mini Apps — `initData` 校验

小程序前端会从 Telegram 收到**已签名**的身份字符串 `Telegram.WebApp.initData`,证明当前是哪位用户在浏览页面。后端在返回任何用户数据前必须校验该签名。

- SDK: `telegramBotApiPhp\WebApp\InitData`

> **绝不可信任 `initDataUnsafe`** —— 相同字段但没有签名;小程序流量**不经过** webhook —— 浏览器直接请求你的域名。

## 后端用法

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

## API

| 方法 | 说明 |
|---|---|
| `validate()` | 完整结果:`ok`, `user`, `auth_date`, `start_param`, `fields`, `hash` |
| `valid()` | 仅布尔值 |
| `user()` | 用户数组或 `null` |
| `build()` | 生成已签名 initData(仅用于测试) |

选项:`max_age` —— `auth_date` 最大有效期(秒),默认 `86400`,`0` 表示不检查。错误码:`empty_init_data`、`bot_token_missing`、`malformed_init_data`、`hash_missing`、`bad_signature`、`auth_date_missing`、`auth_date_expired`。

## 安全清单

- 在服务端对**每个**特权请求校验;`max_age` 保持较短(`3600` 或更小)。
- 用 `hash_equals`(恒定时间)比较,不要用 `===`。
- 不要在日志中记录 `initData` 或 token。
- 算法:`secret = HMAC_SHA256("WebAppData", token)`,再 `HMAC_SHA256(secret, data_check_string)` —— 完整指南见 [mini-apps.md](mini-apps.md)。
