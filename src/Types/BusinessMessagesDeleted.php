<?php
namespace telegramBotApiPhp\Types;

/**
 * Class BusinessMessagesDeleted
 * Represents deleted messages from a connected business account.
 *
 * @property string $business_connection_id Unique identifier of the business connection
 * @property Chat $chat Information about the chat in the business account
 * @property int[] $message_ids List of deleted message IDs in the chat
 */
class BusinessMessagesDeleted extends BaseType
{
}
