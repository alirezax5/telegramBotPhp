<?php
namespace telegramBotApiPhp\Types;

/**
 * Class Gift
 * Represents a gift that can be sent by the bot.
 *
 * @property string $id Unique identifier of the gift
 * @property Sticker $sticker The sticker that represents the gift
 * @property int $star_count The number of Telegram Stars required to send the sticker
 * @property int $upgrade_star_count Optional. The number of Telegram Stars required to upgrade the gift to a unique one
 * @property int $total_count Optional. The total number of gifts of this type that can be sent (for limited gifts only)
 * @property int $remaining_count Optional. The number of remaining gifts of this type that can be sent (for limited gifts only)
 */
class Gift extends BaseType
{
}
