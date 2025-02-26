<?php
namespace telegramBotApiPhp\Types;

/**
 * Class CallbackQuery
 * Represents an incoming callback query from an inline keyboard button.
 * The query can originate from either a bot message or an inline message.
 * Exactly one of data or game_short_name will be present.
 *
 * @property string $id Unique identifier for this query
 * @property User $from Sender of the query
 * @property MaybeInaccessibleMessage $message Optional. Message sent by the bot with the callback button
 * @property string $inline_message_id Optional. Identifier of the message sent in inline mode
 * @property string $chat_instance Global identifier, corresponding to the chat to which the message was sent
 * @property string $data Optional. Data associated with the callback button
 * @property string $game_short_name Optional. Short name of a Game to be returned
 */
class CallbackQuery extends BaseType
{
}
