<?php

namespace telegramBotApiPhp\Traits;

trait otherTrait
{

    protected function getCachedValue($key, $callback)
    {
        if (isset($this->cacheField[$key])) {
            return $this->cacheField[$key];
        }

        $value = $callback();
        $this->cacheField[$key] = $value;
        return $value;
    }


    protected function getMessageData($property, $default = null)
    {
        return $this->getCachedValue($property, function () use ($property, $default) {
            if ($this->isMessage()) {
                return $this->message()->$property ?? $default;
            }
            if ($this->isBusinessMessage() && isset($this->businessMessage()->$property)) {
                return $this->businessMessage()->$property;
            }
            if ($this->isCallbackQuery()) {

                if (is_object($this->callbackQuery()->message) || is_array($this->callbackQuery()->message))
                    return $this->callbackQuery()->message->$property;

                return $this->callbackQuery()->$property;
            }
            if ($this->isChannelPost()) {
                return $this->channelPost()->$property ?? $default;
            }
            if ($this->isEditedMessage()) {
                return $this->editedMessage()->$property ?? $default;
            }
            if ($this->isEditedChannelPost()) {
                return $this->editedChannelPost()->$property ?? $default;
            }
            if ($this->isInlineQuery() && isset($this->inlineQuery()->$property)) {
                return $this->inlineQuery()->$property;
            }
            if ($this->isPreCheckoutQuery()) {
                return $this->preCheckoutQuery()->$property;
            }
            if ($this->isMyChatMember()) {
                return $this->myChatMember()->$property;
            }
            return $default;
        });
    }

    public function messageID()
    {
        return $this->getMessageData('message_id');
    }

    public function text()
    {
        return $this->getMessageData('text');
    }

    public function fromId()
    {
        if (($this->isCallbackQuery()) and $this->isPrivate())
            return $this->getMessageData('chat')->id ?? null;

        return $this->getMessageData('from')->id ?? null;
    }

    public function chatId()
    {
        if (($this->isPreCheckoutQuery()))
            return $this->getMessageData('from')->id ?? null;

        return $this->getMessageData('chat')->id ?? null;
    }

    public function firstName()
    {
        return $this->getMessageData('from')->first_name ?? null;
    }

    public function languageCode()
    {
        return $this->getMessageData('from')->language_code ?? null;
    }

    public function isPremium()
    {
        return $this->getMessageData('from')->is_premium ?? null;
    }

    public function lastName()
    {
        return $this->getMessageData('from')->last_name ?? null;
    }

    public function username()
    {
        return $this->getMessageData('from')->username ?? null;
    }

    public function chatType()
    {
        return $this->getMessageData('chat')->type ?? null;
    }

    public function msgType()
    {
        return $this->getCachedValue('msgType', function () {
            if ($this->mediaType()) {
                return self::_MEDIA;
            }
            if ($this->message()->forward_origin ?? false) {
                return self::_FORWARD;
            }
            return self::_TEXT;
        });
    }

    public function mediaType()
    {
        return $this->getCachedValue('mediaType', function () {
            if (!$this->isMessage()) {
                return false;
            }
            $message = $this->message();
            $messageArray = get_object_vars($message->video); // تبدیل شیء به آرایه
            file_put_contents('1.json', json_encode($messageArray));

            foreach ([
                         'video' => self::_VIDEO,
                         'photo' => self::_PHOTO,
                         'audio' => self::_AUDIO,
                         'voice' => self::_VOICE,
                         'animation' => self::_ANIMATION,
                         'video_note' => self::_VIDEO_NOTE,
                         'contact' => self::_CONTACT,
                         'document' => self::_DOCUMENT,
                         'sticker' => self::_STICKER,
                         'game' => self::_GAME,
                         'location' => self::_LOCATION,
                     ] as $type => $constant) {
                $value = $message->$type;

                if (is_object($value) || is_array($value)) {

                    return $constant;
                }
            }
            return self::_TEXT;
        });
    }

    public function fileId()
    {
        return $this->getCachedValue('fileId', function () {
            if (!$this->isMessage()) {
                return null;
            }
            $message = $this->message();
            foreach ([
                         'document' => 'file_id',
                         'audio' => 'file_id',
                         'photo' => 'file_id',
                         'video_note' => 'file_id',
                         'video' => 'file_id',
                         'voice' => 'file_id',
                         'sticker' => 'file_id',
                         'animation' => 'file_id',
                     ] as $type => $property) {
                if (isset($message->$type)) {
                    return $message->$type->$property;
                }
            }
            return null;
        });
    }

    public function mimeType()
    {
        return $this->getCachedValue('mime_type', function () {
            if (!$this->isMessage()) {
                return null;
            }
            $message = $this->message();
            foreach ([
                         'document' => 'mime_type',
                         'audio' => 'mime_type',
                         'photo' => 'mime_type',
                         'video_note' => 'mime_type',
                         'video' => 'mime_type',
                         'voice' => 'mime_type',
                         'sticker' => 'mime_type',
                         'animation' => 'mime_type',
                     ] as $type => $property) {
                if (is_object($message->$type) or ($type == 'photo') and is_array($message->$type)) {

                    if ($type == 'photo') {
                        return $message->photo[0]->$property;

                    }
                    return $message->{$type}->{$property};
                }
            }
            return null;
        });
    }

    public function fileSize()
    {
        return $this->getCachedValue('fileSize', function () {
            if (!$this->isMessage()) {
                return null;
            }
            $message = $this->message();
            foreach ([
                         'document' => 'file_size',
                         'audio' => 'file_size',
                         'photo' => 'file_size',
                         'video_note' => 'file_size',
                         'video' => 'file_size',
                         'voice' => 'file_size',
                         'sticker' => 'file_size',
                         'animation' => 'file_size',
                     ] as $type => $property) {
                if (isset($message->$type)) {
                    return $message->$type->$property;
                }
            }
            return null;
        });
    }

    public function caption()
    {
        return $this->getCachedValue('caption', function () {
            if ($this->isBusiness() && isset($this->businessMessage()->caption)) {
                return $this->businessMessage()->caption;
            }
            if ($this->isEditedMessage() && isset($this->editedMessage()->caption)) {
                return $this->editedMessage()->caption;
            }
            if ($this->isEditedChannelPost() && isset($this->editedChannelPost()->caption)) {
                return $this->editedChannelPost()->caption;
            }
            if ($this->channelPost() && isset($this->channelPost()->caption)) {
                return $this->channelPost()->caption;
            }
            if ($this->message() && isset($this->message()->caption)) {
                return $this->message()->caption;
            }
            return null;
        });
    }

    public function pathToUrl($path)
    {
        return strtr($this->urlFile, ['{url}' => $this->apiUrl, '{token}' => $this->botToken]) . $path;
    }
}