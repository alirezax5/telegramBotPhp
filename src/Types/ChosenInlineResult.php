<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ChosenInlineResult
 * Represents a result of an inline query that was chosen by the user and sent to their chat partner.
 *
 * @property string $result_id Unique identifier for the result that was chosen
 * @property User $from The user that chose the result
 * @property Location|null $location Optional. Sender location, only for bots that require user location
 * @property string|null $inline_message_id Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message. Will be also received in callback queries and can be used to edit the message.
 * @property string $query The query that was used to obtain the result
 */
class ChosenInlineResult extends BaseType
{
}
