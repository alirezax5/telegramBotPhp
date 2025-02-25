<?php
namespace telegramBotApiPhp\Types;

/**
 * Class SharedUser
 * Contains information about a user that was shared with the bot using a KeyboardButtonRequestUsers button.
 *
 * @property int $user_id Identifier of the shared user. This number may have more than 32 significant bits.
 * @property string|null $first_name Optional. First name of the user, if requested by the bot.
 * @property string|null $last_name Optional. Last name of the user, if requested by the bot.
 * @property string|null $username Optional. Username of the user, if requested by the bot.
 * @property PhotoSize[] $photo Array of PhotoSize representing the user's profile photo.
 */
class SharedUser extends BaseType
{
}
