<?php

namespace telegramBotApiPhp\Traits;

trait IsMedia
{
    protected static $mediaTypes = [
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
    ];

    public function isVideo(): bool
    {
        return $this->isMediaType('video');
    }

    public function isPhoto(): bool
    {
        return $this->isMediaType('photo');
    }

    public function isAudio(): bool
    {
        return $this->isMediaType('audio');
    }

    public function isVoice(): bool
    {
        return $this->isMediaType('voice');
    }

    public function isAnimation(): bool
    {
        return $this->isMediaType('animation');
    }

    public function isVideoNote(): bool
    {
        return $this->isMediaType('video_note');
    }

    public function isContact(): bool
    {
        return $this->isMediaType('contact');
    }

    public function isDocument(): bool
    {
        return $this->isMediaType('document');
    }

    public function isSticker(): bool
    {
        return $this->isMediaType('sticker');
    }

    public function isGame(): bool
    {
        return $this->isMediaType('game');
    }

    public function isLocation(): bool
    {
        return $this->isMediaType('location');
    }

    public function isMedia(): bool
    {
        foreach (self::$mediaTypes as $type => $constant) {
            if ($this->isMediaType($type)) {
                return true;
            }
        }
        return false;
    }

    protected function isMediaType(string $type): bool
    {
        return $this->mediaType() === self::$mediaTypes[$type];
    }
}