# Changelog — telegramBotPhp

All notable changes to this project are documented in this file.
The format is based on [Keep a Changelog](https://keepachangelog.com/); versioning follows [SemVer](https://semver.org/).

## [Unreleased]

### Added — docs: one webhook file, many bots (`secret_token` routing)

- `docs/en/guides/multi-bot.md` (+ all 6 translations) gained the `secret_token`
  webhook routing pattern with a minimal `hook.php` router example: any number of
  bots from one webhook file, bot tokens never in URLs, the per-bot secret doubles
  as the inbound authenticity check (403 otherwise). Verified live 2026-10-11 with
  two real bots: 7/7 deliveries, correct identity every time. Also added a short
  token-storage note (`.env` / encrypted DB registry / Managed Bots live fetch).

## [3.3.0] — 2026-10-11

### Added — multilingual documentation

- The complete documentation set (5 architecture references + 3 guides) now ships in **seven languages** under per-language folders: `docs/en/` (canonical), `docs/fa/`, `docs/zh/`, `docs/ru/`, `docs/fr/`, `docs/pt/`, `docs/ar/`.
- Language hub added at `docs/README.md`; per-language READMEs (`README.md`, `README.fa.md`, `README.zh.md`, `README.ru.md`, `README.fr.md`, `README.pt.md`, `README.ar.md`) with a language switcher at the top of each.

### Fixed
- **`getChatMember()` was broken in 3.2.1** — `returnedChatMember` was referenced without its `telegramBotApiPhp\Types` import in `ChatAdministration.php`, so every call threw
  `Class "telegramBotApiPhp\Traits\returnedChatMember" not found`.
  Found and verified live during a two-bot integration test.
- **JSON serialization of nested API parameters** — `prepareBotData()` now JSON-encodes every
  parameter the Bot API accepts as a nested value:
  `message_ids`, `allowed_updates`, `results`, `reaction`, `emoji_list`, `keywords`,
  `custom_emoji_ids`, `mask_position`, `suggested_tip_amounts`, `rights`,
  `chat_administrator_rights`, `entities`, `caption_entities`, `text_entities`,
  `explanation_entities`, `link_preview_options`, `reply_parameters`.
  Previously these were sent as raw PHP arrays, which Telegram rejects with
  `Bad Request: can't parse ...`.
- **Local-file uploads preserved** — file-bearing parameters (`media`, `stickers`,
  `sticker`, `thumbnail`, `photo`, `video`, ...) are handled by `prepareMediaForUpload()`
  BEFORE any JSON encoding; `stickers` items now also convert local paths to `CURLFile`,
  so `createNewStickerSet()` works with local files too.
- **Null parameters stripped** — `prepareBotData()` removes `null` values from every
  request payload, so nullable arguments (e.g. `getUpdates(..., allowed_updates: null)`,
  `editMessageReplyMarkup(null, ...)`) no longer reach Telegram as empty strings.
- **cURL timeout leak fixed** — the persistent handle now resets `CURLOPT_TIMEOUT` to the
  configured `curlTimeout` on every call before a long-poll `getUpdates` raises it;
  non-poll calls no longer inherit a raised timeout from a previous long poll.

### Verified live (two real bots, one PHP process)
| Check | Result |
|---|---|
| `callRaw('getMe')` on two independent instances | two different identities ✔ |
| `switchToken()` → `restoreToken()` round-trip on one instance | identity restored ✔ |
| Scenario A — `getChatMember()` executed by bot #2's token inside bot #1's process | `ok=true`, `status=member` (13 ms) ✔ |
| Scenario B — bot #1 sends a message to the user **as bot #2** via the token stack | delivered ✔ |
| `deleteMessages()` with new `message_ids` JSON encoding | accepted ✔ |
| `sendMessage(entities: [...])` with new `entities` JSON encoding | accepted ✔ |
| Full plugin harness suite (`MultiBotTestPlugin`) | 5/5 PASS in 393 ms ✔ |

## [3.2.1] — 2026-08-10
Baseline this release builds on. See `git log` for earlier history
(3.0.0 initial modern release, 3.0.1, 3.1.1, 3.2.0, 3.2.1).
