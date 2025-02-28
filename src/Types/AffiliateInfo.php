<?php
namespace telegramBotApiPhp\Types;

/**
 * Class AffiliateInfo
 * Contains information about the affiliate that received a commission via this transaction.
 *
 * @property User|null $affiliate_user The bot or the user that received an affiliate commission if it was received by a bot or a user
 * @property Chat|null $affiliate_chat The chat that received an affiliate commission if it was received by a chat
 * @property int $commission_per_mille The number of Telegram Stars received by the affiliate for each 1000 Telegram Stars received by the bot from referred users
 * @property int $amount Integer amount of Telegram Stars received by the affiliate from the transaction, rounded to 0; can be negative for refunds
 * @property int|null $nanostar_amount The number of 1/1000000000 shares of Telegram Stars received by the affiliate; from -999999999 to 999999999; can be negative for refunds
 */
class AffiliateInfo extends BaseType
{
}
