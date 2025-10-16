<?php

namespace telegramBotApiPhp\Types;

/**
 * Class OwnedGift
 *
 *
 * @property string $type
 * @property Gift[] $gift
 * @property string $owned_gift_id
 * @property User $sender_user
 * @property int $send_date
 * @property string $text
 * @property MessageEntity[] $entities
 * @property bool $is_private
 * @property bool $is_saved
 * @property bool $can_be_upgraded
 * @property bool $was_refunded
 * @property int $convert_star_count
 * @property int $prepaid_upgrade_star_count
 * @property int $next_transfer_date
 */
class OwnedGift extends BaseType
{
}
