<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ChatBoostSource
 * Represents the source of a chat boost.
 *
 * @property string $source Source of the boost ("premium" or "giveaway")
 * @property User $user User that boosted the chat
 * @property int $giveaway_message_id Optional. ID of the giveaway message in the chat
 * @property User $winner Optional. User that won the giveaway prize (for Telegram Premium giveaways)
 * @property int $prize_star_count Optional. Telegram Stars to be split among winners (for Telegram Star giveaways)
 * @property bool $is_unclaimed Optional. True if the giveaway ended with no winner
 */
class ChatBoostSource extends BaseType
{
}
