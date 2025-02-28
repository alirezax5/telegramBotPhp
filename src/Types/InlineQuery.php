<?php
namespace telegramBotApiPhp\Types;

/**
 * Class InlineQuery
 * Represents an incoming inline query.
 *
 * @property string $id Unique identifier for this query
 * @property User $from Sender
 * @property string $query Text of the query (up to 256 characters)
 * @property string $offset Offset of the results to be returned, can be controlled by the bot
 * @property string|null $chat_type Optional. Type of the chat from which the inline query was sent
 * @property Location|null $location Optional. Sender location, only for bots that request user location
 */
class InlineQuery extends BaseType
{
}
