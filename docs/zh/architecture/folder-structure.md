# 目录结构

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

## src/ 布局

| 路径 | 用途 |
|------|---------|
| `Telegram.php` | 核心类 —— 用令牌构造；持有 HTTP 客户端、更新数据、缓存、令牌栈、重试配置。 |
| `Traits/method.php` | 聚合器 trait，它 `use` 全部 7 个领域 trait，并定义共享的私有 `call()`/`prepareBotData()`/媒体辅助方法。 |
| `Traits/{Updates,Messages,ChatAdministration,Stickers,PaymentsAndGames,Business,BotSettings}.php` | **186 个 API 方法**，按 API 领域分组。 |
| `Traits/{isUpdates,isChatTypes,isMedia}.php` | 更新/聊天/媒体类型的布尔检查器。 |
| `Traits/otherTrait.php` | 便捷取值器（`text()`、`chatId()`、`fileId()` 等）。 |
| `Types/BaseType.php` | 所有类型的抽象基类 —— 惰性 `__get`/`toArray`、`JsonSerializable`、可迭代。 |
| `Types/returned*.php` | 类型化的响应包装器（例如 `returnedMessage`、`returnedUser`）。 |
| `Types/*.php` | 实体类型（Message、User、Chat、InlineKeyboardMarkup、InputRichMessage 等）。 |

```
原因：SDK 刻意保持扁平的形态 —— 所有行为都位于 Telegram 上（通过 trait），所有数据都是 BaseType 的子类。

另请参阅 [methods.md](methods.md) 和 [telegram-class.md](telegram-class.md)。
