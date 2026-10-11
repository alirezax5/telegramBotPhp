# 架构概览

**telegramBotPhp** 是一个轻量级、零依赖的 PHP 8.1+ Telegram Bot API 封装库。

## 目的

通过一个符合人体工程学的面向对象 PHP 接口暴露每一个 Telegram Bot API 方法，同时把运行时负担保持在最低限度（仅 PHP + cURL —— 无外部包、无框架）。

## 范围与数字

| 指标 | 值 |
|--------|-------|
| 覆盖的 Bot API 方法 | **186** |
| 类型化的响应/实体类 | **199** |
| PHP 版本 | >= 8.1 |
| 运行时依赖 | **0**（使用 `ext-curl`、`ext-json`） |
| 数据风格 | PSR-4 自动加载；`stdClass` 解码 + 惰性类型化包装器 |

## 对 API 的扩展

该封装库把每个端点映射为 `Telegram` 上的一个**方法**（通过领域 *trait* 混入），并把每个 JSON 响应/实体映射为 `src/Types/` 下的一个**类型**类。

## 设计目标

1. **完整性** —— 与 `https://core.telegram.org/bots/api` 上的官方 Bot API 保持同步。
2. **易用性** —— 在原始对象之上提供友好的取值器（`text()`、`chatId()`、`mediaType()`）。
3. **可靠性** —— 内置带指数退避的 HTTP 重试 + `retry_after` 处理、可复用的 cURL 句柄、长轮询超时支持。
4. **零锁定** —— 无框架依赖；可用于 Webhook 或长轮询脚本。

目录布局见 [folder-structure.md](folder-structure.md)，API 表面见 [methods.md](methods.md)，核心类见 [telegram-class.md](telegram-class.md)。
