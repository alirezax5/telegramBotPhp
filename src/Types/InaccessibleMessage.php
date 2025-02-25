<?php
namespace telegramBotApiPhp\Types;

/**
 * Class InaccessibleMessage
 * Represents a message that was deleted or is otherwise inaccessible to the bot.
 *
 * @property Chat $chat Chat the message belonged to.
 * @property int $message_id Unique message identifier inside the chat.
 * @property int $date Always 0. Used to differentiate regular and inaccessible messages.
 */
class InaccessibleMessage extends BaseType
{
}
