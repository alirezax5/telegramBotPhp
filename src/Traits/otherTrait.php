<?php

declare(strict_types=1);

namespace telegramBotApiPhp\Traits;

trait otherTrait
{
    /**
     * دریافت مقدار کش‌شده یا محاسبه آن
     */
    protected function getCachedValue(string $key, callable $callback): mixed
    {
        if (array_key_exists($key, $this->cacheField ?? [])) {
            return $this->cacheField[$key];
        }

        return $this->cacheField[$key] = $callback();
    }

    /**
     * دریافت داده از پیام، callback_query، business_message و غیره
     */
    protected function getMessageData(string $property, mixed $default = null): mixed
    {
        return $this->getCachedValue($property, function () use ($property, $default) {
            // اولویت: پیام معمولی
            if ($this->isMessage()) {
                return $this->message()?->{$property} ?? $default;
            }

            // Callback Query
            if ($this->isCallbackQuery()) {
                $callbackQuery = $this->callbackQuery();

                if ($callbackQuery?->message) {
                    return $callbackQuery->message->{$property} ?? $default;
                }

                return $callbackQuery?->{$property} ?? $default;
            }

            // Business Message
            if (method_exists($this, 'isBusinessMessage') && $this->isBusinessMessage()) {
                return $this->businessMessage()?->{$property} ?? $default;
            }

            // Channel Post
            if (method_exists($this, 'isChannelPost') && $this->isChannelPost()) {
                return $this->channelPost()?->{$property} ?? $default;
            }

            // Edited Message
            if ($this->isEditedMessage()) {
                return $this->editedMessage()?->{$property} ?? $default;
            }

            // Edited Channel Post
            if (method_exists($this, 'isEditedChannelPost') && $this->isEditedChannelPost()) {
                return $this->editedChannelPost()?->{$property} ?? $default;
            }

            // Pre Checkout Query
            if ($this->isPreCheckoutQuery()) {
                return $this->preCheckoutQuery()?->{$property} ?? $default;
            }

            return $default;
        });
    }

    // ====================== Message Info ======================

    public function messageID(): ?int
    {
        return $this->getMessageData('message_id');
    }

    public function text(): ?string
    {
        return $this->getMessageData('text');
    }

    public function caption(): ?string
    {
        return $this->getCachedValue('caption', function (): ?string {
            if ($this->isEditedMessage()) {
                return $this->editedMessage()?->caption;
            }
            if (method_exists($this, 'isEditedChannelPost') && $this->isEditedChannelPost()) {
                return $this->editedChannelPost()?->caption;
            }
            return $this->message()?->caption ?? $this->getMessageData('caption');
        });
    }

    // ====================== User & Chat Info ======================

    public function fromId(): ?int
    {
        return $this->getCachedValue('fromId', function (): ?int {
            if ($this->isCallbackQuery()) {
                return $this->callbackQuery()?->from?->id
                    ?? $this->callbackQuery()?->message?->chat?->id;
            }

            if ($this->isPreCheckoutQuery()) {
                return $this->preCheckoutQuery()?->from?->id;
            }

            return $this->message()?->from?->id ?? $this->getMessageData('from')?->id;
        });
    }

    public function chatId(): ?int
    {
        return $this->getCachedValue('chatId', function (): ?int {
            if ($this->isPreCheckoutQuery()) {
                return $this->preCheckoutQuery()?->from?->id;
            }

            return $this->getMessageData('chat')?->id;
        });
    }

    public function firstName(): ?string
    {
        return $this->getMessageData('from')?->first_name;
    }

    public function lastName(): ?string
    {
        return $this->getMessageData('from')?->last_name;
    }

    public function username(): ?string
    {
        return $this->getMessageData('from')?->username;
    }

    public function languageCode(): ?string
    {
        return $this->getMessageData('from')?->language_code;
    }

    public function isPremium(): ?bool
    {
        return $this->getMessageData('from')?->is_premium;
    }

    public function chatType(): ?string
    {
        return $this->getMessageData('chat')?->type;
    }

    // ====================== Message Type Detection ======================

    public function msgType(): string
    {
        return $this->getCachedValue('msgType', function (): string {
            if ($this->mediaType() !== self::_TEXT) {
                return self::_MEDIA;
            }

            if ($this->message()?->forward_origin ?? $this->getMessageData('forward_origin')) {
                return self::_FORWARD;
            }

            return self::_TEXT;
        });
    }

    public function mediaType(): string
    {
        return $this->getCachedValue('mediaType', function (): string {
            if (!$this->isMessage()) {
                return self::_TEXT;
            }

            $message = $this->message();

            $mediaMap = [
                'video'       => self::_VIDEO,
                'photo'       => self::_PHOTO,
                'audio'       => self::_AUDIO,
                'voice'       => self::_VOICE,
                'animation'   => self::_ANIMATION,
                'video_note'  => self::_VIDEO_NOTE,
                'contact'     => self::_CONTACT,
                'document'    => self::_DOCUMENT,
                'sticker'     => self::_STICKER,
                'game'        => self::_GAME,
                'location'    => self::_LOCATION,
            ];

            foreach ($mediaMap as $key => $type) {
                if (!empty($message?->{$key})) {
                    return $type;
                }
            }

            return self::_TEXT;
        });
    }

    // ====================== File Info ======================

    public function fileId(): ?string
    {
        return $this->getCachedValue('fileId', function (): ?string {
            if (!$this->isMessage()) {
                return null;
            }

            $message = $this->message();
            $types = ['document', 'audio', 'video_note', 'video', 'voice', 'sticker', 'animation'];

            foreach ($types as $type) {
                if (!empty($message?->{$type})) {
                    return $message->{$type}->file_id ?? null;
                }
            }

            // Photo (largest size)
            if (!empty($message?->photo)) {
                return $message->photo[array_key_last($message->photo)]->file_id ?? null;
            }

            return null;
        });
    }

    public function mimeType(): ?string
    {
        return $this->getCachedValue('mimeType', function (): ?string {
            if (!$this->isMessage()) {
                return null;
            }

            $message = $this->message();
            $types = ['document', 'audio', 'video_note', 'video', 'voice', 'sticker', 'animation'];

            foreach ($types as $type) {
                if (!empty($message?->{$type})) {
                    return $message->{$type}->mime_type ?? null;
                }
            }

            if (!empty($message?->photo)) {
                return $message->photo[array_key_last($message->photo)]->mime_type ?? null;
            }

            return null;
        });
    }

    public function fileSize(): ?int
    {
        return $this->getCachedValue('fileSize', function (): ?int {
            if (!$this->isMessage()) {
                return null;
            }

            $message = $this->message();
            $types = ['document', 'audio', 'video_note', 'video', 'voice', 'sticker', 'animation'];

            foreach ($types as $type) {
                if (!empty($message?->{$type})) {
                    return $message->{$type}->file_size ?? null;
                }
            }

            if (!empty($message?->photo)) {
                return $message->photo[array_key_last($message->photo)]->file_size ?? null;
            }

            return null;
        });
    }

    // ====================== Utility Methods ======================

    /**
     * آیا پیام ریپلای شده است؟
     */
    public function isReply(): bool
    {
        return $this->getMessageData('reply_to_message') !== null;
    }

    /**
     * شناسه پیامی که به آن ریپلای شده
     */
    public function replyToMessageId(): ?int
    {
        return $this->getMessageData('reply_to_message')?->message_id;
    }

    /**
     * تبدیل path فایل به URL دانلود
     */
    public function pathToUrl(string $path): string
    {
        return rtrim($this->apiUrl, '/')
            . '/file/bot'
            . $this->botToken
            . '/'
            . ltrim($path, '/');
    }

    /**
     * پاک‌سازی کش
     */
    public function clearCache(): void
    {
        $this->cacheField = [];
    }
}