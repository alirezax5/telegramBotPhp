# 类型系统

来自 Bot API 的每个 JSON 响应都会被解码为 `stdClass`，然后被包装进一个 `BaseType` 子类（惰性的、魔法 `__get`）。

## BaseType

`telegramBotApiPhp\Types\BaseType`（抽象类）实现了：

- `__get(string $name): mixed` — 从底层数组读取；对缺失的键返回 `null`。
- `__isset(string $name): bool`
- `getIterator(): \Traversable`
- `toArray(): array` — 递归的：嵌套的 `BaseType` 以及 `BaseType` 数组都会被转换。
- `jsonSerialize(): array` — 因此 `json_encode($type)` 可用。
- `static create(array|object $data): static` — 所有 API 方法使用的工厂方法。

数据可以以 `stdClass`（构造函数通过 `get_object_vars` 转换）、数组或另一个 `BaseType` 的形式到达。

## returned* 响应包装器

每个 API 方法都会返回一个**响应**类型，例如：

| 响应类 | 结果载荷 |
|----------------|----------------|
| `returned`               | `bool`（成功） |
| `returnedMessage`        | `Message` |
| `returnedUser`           | `User` |
| `returnedChat`           | `ChatFullInfo` |
| `returnedChatMember`     | `ChatMember` |
| `returnedFile`           | `File` |
| `returnedBotShortDescription` | `BotShortDescription` |
| `returnedArrayOfMessageId`、`returnedArrayOfChatMember` 等 | 实体数组 |
| `returnedInt`、`returnedString` | 标量 |

它们是薄薄的类型化包装器：`ok`、`error_code`、`description` + `result`。

## 实体类型

Message、User、Chat、ChatMember、StickerSet、Poll、GameHighScore、InlineQueryResult、InputMedia、InputRichMessage 等 —— 共 199 个类，全部继承自 `BaseType`。

## 为什么使用魔法属性而不是类型化的公共属性？

- 零维护成本：新的 API 字段自动可用（向前兼容）。
- 原始的更新/响应对象始终保持为唯一的事实来源。
- 权衡：字段没有 IDE 自动补全（参见 [methods.md](methods.md) 中的重构思路 / 项目路线图）。

要取回原始数据：`$type->toArray()` 或 `json_encode($type)`。
