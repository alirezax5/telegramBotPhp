<?php

declare(strict_types=1);

namespace telegramBotApiPhp\Traits;

/**
 * Aggregator trait — composes all domain-specific API method traits.
 *
 * Keeps backward compatibility: any class using `method` still gets all 176+ API methods.
 * Methods are split across domain traits for maintainability, then pulled in here.
 *
 * @see Updates         — getUpdates, setWebhook, getMe, logOut, close
 * @see Messages        — sendMessage, sendPhoto, editMessageText, deleteMessage, ...
 * @see ChatAdministration — banChatMember, pinChatMessage, createForumTopic, ...
 * @see Stickers        — sendSticker, getStickerSet, createNewStickerSet, ...
 * @see PaymentsAndGames  — sendInvoice, createInvoiceLink, sendGame, ...
 * @see Business        — getBusinessConnection, sendGift, postStory, ...
 * @see BotSettings     — setMyCommands, getMyName, setMyProfilePhoto, ...
 */
trait method
{
    use Updates;
    use Messages;
    use ChatAdministration;
    use Stickers;
    use PaymentsAndGames;
    use Business;
    use BotSettings;

    /**
     * JSON-encode array fields and prepare file uploads.
     *
     * The Telegram Bot API requires nested objects/arrays to arrive as
     * JSON-serialized strings. Every API parameter that accepts such a
     * nested value must be listed in $jsonFields, otherwise the raw PHP
     * array is sent and Telegram answers "Bad Request: can't parse ...".
     */
    private function prepareBotData(array $data): array
    {
        $jsonFields = [
            // Keyboard / markup (file-bearing 'media'/'thumbnail' live in prepareMediaForUpload)
            'reply_markup',
            // Commerce
            'prices', 'suggested_tip_amounts',
            // Polls
            'options', 'explanation_entities',
            // Bot settings / profile
            'commands', 'errors', 'accepted_gift_types', 'rights',
            // Chat administration
            'permissions', 'chat_administrator_rights',
            // Inline & web apps
            'result', 'results', 'content', 'button', 'rich_message',
            // Checklists (business)
            'checklist',
            // Stickers (file-bearing 'stickers' list is handled in prepareMediaForUpload)
            'emoji_list', 'keywords', 'custom_emoji_ids', 'mask_position',
            // Reactions
            'reaction',
            // Bulk message operations
            'message_ids',
            // Updates & webhooks
            'allowed_updates',
            // Text formatting
            'entities', 'caption_entities', 'text_entities',
            // Link preview & reply targeting
            'link_preview_options', 'reply_parameters',
        ];

        foreach ($jsonFields as $field) {
            if (isset($data[$field]) && is_array($data[$field])) {
                $data[$field] = json_encode(
                    $data[$field],
                    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
                );
            }
        }

        $data = $this->prepareMediaForUpload($data);

        // Drop null values so Telegram never receives empty parameters —
        // nullable compact()'ed arguments (e.g. getUpdates timeout) and
        // optional nulls (editMessageReplyMarkup) must be omitted entirely.
        return array_filter($data, static fn ($v) => $v !== null);
    }

    /**
     * تبدیل خودکار مسیر فایل‌های محلی به CURLFile
     */
    private function prepareMediaForUpload(array $data): array
    {
        $fileFields = [
            'photo', 'video', 'audio', 'voice', 'animation', 'document',
            'sticker', 'video_note', 'thumbnail', 'certificate'
        ];

        foreach ($fileFields as $field) {
            if (isset($data[$field]) && !is_array($data[$field])) {
                $data[$field] = $this->prepareFileInput($data[$field]);
            }
        }

        if (isset($data['sticker']) && is_array($data['sticker'])) {
            if (isset($data['sticker']['media'])) {
                $data['sticker']['media'] = $this->prepareFileInput($data['sticker']['media']);
            }
            $data['sticker'] = json_encode($data['sticker'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        if (isset($data['media']) && is_array($data['media'])) {
            if (isset($data['media']['media'])) {
                $data['media']['media'] = $this->prepareFileInput($data['media']['media']);
                $data['media'] = json_encode($data['media'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            } else {
                $data['media'] = $this->prepareMediaGroup($data['media']);
            }
        }

        if (isset($data['stickers']) && is_array($data['stickers'])) {
            foreach ($data['stickers'] as &$item) {
                if (is_array($item) && isset($item['sticker'])) {
                    $item['sticker'] = $this->prepareFileInput($item['sticker']);
                }
            }
            unset($item);
            $data['stickers'] = json_encode($data['stickers'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        return $data;
    }

    /**
     * آماده‌سازی تک فایل
     */
    private function prepareFileInput($input)
    {
        if ($input instanceof \CURLFile) {
            return $input;
        }

        if (is_string($input) && file_exists($input) && is_readable($input)) {
            return new \CURLFile($input);
        }

        if (is_string($input)) {
            return $input;
        }

        return $input;
    }

    /**
     * آماده‌سازی آرایه media برای sendMediaGroup
     */
    private function prepareMediaGroup(array $mediaItems): string
    {
        foreach ($mediaItems as &$item) {
            if (is_array($item) && isset($item['media'])) {
                $item['media'] = $this->prepareFileInput($item['media']);
            }
        }

        return json_encode($mediaItems, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * متد پایه فراخوانی API
     */
    private function call(string $method, array $data = [], bool $isUpload = false): ?\stdClass
    {
        // bot() normalizes now (single choke point) — no pre-pass here.
        $result = $this->bot($method, $data, $isUpload);

        if ($result === null) {
            return (object)[
                'ok' => false,
                'error' => 'Empty API response',
                'http_code' => 0,
                'attempts' => 0,
            ];
        }

        return $result;
    }

    /**
     * فراخوانی خام API — کل پاسخ را برمی‌گرداند (شامل parameters.retry_after)
     */
    public function callRaw(string $method, array $data = [], bool $isUpload = false): ?\stdClass
    {
        return $this->bot($method, $data, $isUpload);
    }
}
