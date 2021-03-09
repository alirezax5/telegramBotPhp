<?php


namespace telegramBotApiPhp\Traits;


trait isChatTypes
{
    public function isPrivate(): bool
    {
        return $this->chatType() == self::PRIVATE;
    }

    public function isGroup(): bool
    {
        return $this->chatType() == self::GROUP;
    }

    public function isSupergroup(): bool
    {
        return $this->chatType() == self::SUPERGROUP;
    }

    public function isChannel(): bool
    {
        return $this->chatType() == self::CHANNEL;
    }
}