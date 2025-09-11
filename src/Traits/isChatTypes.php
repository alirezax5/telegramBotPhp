<?php

namespace telegramBotApiPhp\Traits;

trait isChatTypes
{
    private function isChatType(string $type): bool
    {
        return $this->chatType() == $type;
    }

    public function isPrivate(): bool
    {
        return $this->isChatType(self::PRIVATE);
    }

    public function isGroup(): bool
    {
        return $this->isChatType(self::GROUP);
    }

    public function isSupergroup(): bool
    {
        return $this->isChatType(self::SUPERGROUP);
    }

    public function isChannel(): bool
    {
        return $this->isChatType(self::CHANNEL);
    }
}
