<?php
namespace baleBotPhp\Types;

use baleBotPhp\Types\BaseType;
use baleBotPhp\Types\User;

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
