<?php
namespace telegramBotApiPhp\Types;

/**
 * Class BusinessConnection
 * Describes the bot's connection with a business account.
 *
 * @property string $id Unique identifier of the business connection
 * @property User $user Business account user who created the connection
 * @property int $user_chat_id ID of the private chat with the user
 * @property int $date Unix timestamp of when the connection was established
 * @property bool $can_reply True if the bot can act on behalf of the business in recent chats
 * @property bool $is_enabled True if the connection is active
 */
class BusinessConnection extends BaseType
{
}
