<?php

namespace telegramBotApiPhp\Types;

/**
 * Class BusinessConnection
 * Describes the connection of the bot with a business account.
 *
 * @property string $id Unique identifier of the business connection.
 * @property User $user Business account user that created the business connection.
 * @property int $user_chat_id Identifier of a private chat with the user who created the business connection.
 * @property int $date Date the connection was established in Unix time.
 * @property bool $can_reply True, if the bot can act on behalf of the business account in chats that were active in the last 24 hours.
 * @property bool $is_enabled True, if the connection is active.
 */
class BusinessConnection extends BaseType
{
}
