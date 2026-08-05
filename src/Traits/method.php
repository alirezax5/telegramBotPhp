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
     */
    private function prepareBotData(array $data): array
    {
        $jsonFields = [
            'reply_markup', 'prices', 'options', 'commands', 'errors',
            'accepted_gift_types', 'permissions', 'result', 'checklist',
            'content', 'button', 'rich_message',
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

        return $data;
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
        $data = $this->prepareBotData($data);
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
        return $this->bot($method, $this->prepareBotData($data), $isUpload);
    }
}
