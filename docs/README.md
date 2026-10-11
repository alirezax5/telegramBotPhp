# telegramBotPhp Documentation — Language Hub

Documentation is available in **7 languages**. Every folder below is a complete, self-contained copy of the full doc set (5 architecture references + 3 practical guides):

| Language | Folder | Architecture | Guides |
|---|---|---|---|
| English | [docs/en/](en/) | [overview](en/architecture/overview.md) | [multi-bot](en/guides/multi-bot.md) |
| فارسی (Persian) | [docs/fa/](fa/) | [مرور معماری](fa/architecture/overview.md) | [چندرباته](fa/guides/multi-bot.md) |
| 中文 (Chinese) | [docs/zh/](zh/) | [架构概览](zh/architecture/overview.md) | [多机器人](zh/guides/multi-bot.md) |
| Русский (Russian) | [docs/ru/](ru/) | [обзор архитектуры](ru/architecture/overview.md) | [мульти-бот](ru/guides/multi-bot.md) |
| Français (French) | [docs/fr/](fr/) | [aperçu de l'architecture](fr/architecture/overview.md) | [multi-bot](fr/guides/multi-bot.md) |
| Português (Portuguese) | [docs/pt/](pt/) | [visão da arquitetura](pt/architecture/overview.md) | [multi-bot](pt/guides/multi-bot.md) |
| العربية (Arabic) | [docs/ar/](ar/) | [نظرة على المعمارية](ar/architecture/overview.md) | [عدة بوتات](ar/guides/multi-bot.md) |

## Document index (identical in every language folder)

**`architecture/`**
1. `overview.md` — library at a glance, layer map
2. `folder-structure.md` — `src/` layout, traits and types
3. `telegram-class.md` — the `Telegram` core class
4. `methods.md` — all 186 API methods grouped by trait
5. `type-system.md` — 199 typed responses, `BaseType`, lazy `__get`

**`guides/`**
6. `multi-bot.md` — two bots in one process: independent instances + token stack (live-verified)
7. `webhook-vs-polling.md` — choosing and configuring the update channel
8. `retry-and-resilience.md` — built-in retry, backoff, `retry_after` handling

> **Canonical language:** English (`docs/en/`). Translations are refreshed from the English set at release time — if a translation reads stale, the English original is the source of truth.
