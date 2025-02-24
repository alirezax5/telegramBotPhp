<?php

namespace telegramBotApiPhp\Types;

/**
 * Class MessageOriginChannel
 * This object MessageOrigin a Telegram user or bot.
 * @param string $type Type of the message origin.
 * * @param int $date Date the message was sent originally in Unix time.
 * * @param User|null $sender_user User that sent the message originally (for MessageOriginUser).
 * * @param string|null $sender_user_name Name of the user that sent the message originally (for MessageOriginHiddenUser).
 * * @param Chat|null $sender_chat Chat that sent the message originally (for MessageOriginChat).
 * * @param string|null $author_signature Signature of the original post author (for MessageOriginChat or MessageOriginChannel).
 */
class MessageOriginChannel
{
}
