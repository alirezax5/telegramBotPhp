<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ChatBoost
 * Contains information about a chat boost.
 *
 * @property string $boost_id Unique identifier of the boost
 * @property int $add_date Timestamp when the chat was boosted
 * @property int $expiration_date Timestamp when the boost will expire
 * @property ChatBoostSource $source Source of the added boost
 */
class ChatBoost extends BaseType
{
}
