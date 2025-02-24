<?php

namespace telegramBotApiPhp\Types;

/**
 * Class User
 * This object represents a Telegram user or bot.
 *
 * @property int $id Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
 * @property bool $is_bot True, if this user is a bot.
 * @property string $first_name User's or bot's first name.
 * @property string|null $last_name Optional. User's or bot's last name.
 * @property string|null $username Optional. User's or bot's username.
 * @property string|null $language_code Optional. IETF language tag of the user's language.
 * @property bool|null $is_premium True, if this user is a Telegram Premium user.
 * @property bool|null $added_to_attachment_menu True, if this user added the bot to the attachment menu.
 * @property bool|null $can_join_groups True, if the bot can be invited to groups. Returned only in getMe.
 * @property bool|null $can_read_all_group_messages True, if privacy mode is disabled for the bot. Returned only in getMe.
 * @property bool|null $supports_inline_queries True, if the bot supports inline queries. Returned only in getMe.
 * @property bool|null $can_connect_to_business True, if the bot can be connected to a Telegram Business account to receive its messages. Returned only in getMe.
 * @property bool|null $has_main_web_app True, if the bot has a main Web App. Returned only in getMe.
 */
class User extends BaseType
{
}
