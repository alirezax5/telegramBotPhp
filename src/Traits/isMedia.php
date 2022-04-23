<?php


namespace telegramBotApiPhp\Traits;


trait isMedia
{
    public function isVideo(): bool
    {
        return $this->mediaType() == self::_VIDEO;
    }

    public function isPhoto(): bool
    {
        return $this->mediaType() == self::_PHOTO;
    }

    public function isAudio(): bool
    {
        return $this->mediaType() == self::_AUDIO;
    }

    public function isVoice(): bool
    {
        return $this->mediaType() == self::_VOICE;
    }

    public function isAnimation(): bool
    {
        return $this->mediaType() == self::_ANIMATION;
    }

    public function isVideoNote(): bool
    {
        return $this->mediaType() == self::_VIDEO_NOTE;
    }

    public function isContact(): bool
    {
        return $this->mediaType() == self::_CONTACT;
    }

    public function isDocument(): bool
    {
        return $this->mediaType() == self::_DOCUMENT;
    }

    public function isSticker(): bool
    {
        return $this->mediaType() == self::_STICKER;
    }

    public function isGame(): bool
    {
        return $this->mediaType() == self::_GAME;
    }

    public function isLocation(): bool
    {
        return $this->mediaType() == self::_LOCATION;
    }

    public function isMedia()
    {
        return $this->isVideo() or $this->isPhoto() or $this->isAudio() or $this->isVoice() or $this->isAnimation() or $this->isVideoNote() or $this->isContact() or $this->isDocument() or $this->isSticker() or $this->isGame() or $this->isLocation()  ;
    }
}
