<?php
namespace telegramBotApiPhp\Types;

use telegramBotApiPhp\Types\BaseType;
use telegramBotApiPhp\Types\User;

/**
 * Class ChatMemberUpdated
 * This object contains information about one member of a chat.
 *
 * @property string $status The member's status in the chat (e.g., "creator", "administrator", "member", "restricted").
 * @property User $user Information about the user.
 */
class ChatMemberUpdated extends BaseType
{
}
