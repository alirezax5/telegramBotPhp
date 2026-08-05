# Project Overview

**telegramBotPhp** is a lightweight, zero-dependency PHP 8.1+ wrapper for the Telegram Bot API.

## Purpose

Expose every Telegram Bot API method through an ergonomic, object-oriented PHP surface while keeping the runtime background minimal (PHP + cURL only — no external packages, no framework).

## Scope & Numbers

| Metric | Value |
|--------|-------|
| Bot API methods covered | **186** |
| Typed response/entity classes | **199** |
| PHP version | >= 8.1 |
| Runtime dependencies | **0** (uses `ext-curl`, `ext-json`) |
| Data style | PSR-4 autoload; `stdClass` decode + lazy typed wrappers |

## Extension of the API

The wrapper maps every endpoint to a **method** on `Telegram` (mixed in via domain *traits*), and every JSON response/entity to a **type** class under `src/Types/`.

## Design goals

1. **Completeness** — keep in sync with the official Bot API at `https://core.telegram.org/bots/api`.
2. **Ergonomics** — friendly getters (`text()`, `chatId()`, `mediaType()`) on top of raw objects.
3. **Reliability** — built-in HTTP retry with exponential backoff + `retry_after` handling, reusable cURL handle, long-poll timeout support.
4. **Zero lock-in** — no framework dependencies; usable from webhook or long-polling scripts.

See [folder-structure.md](folder-structure.md) for layout, [methods.md](methods.md) for the API surface, and [telegram-class.md](telegram-class.md) for the core class.