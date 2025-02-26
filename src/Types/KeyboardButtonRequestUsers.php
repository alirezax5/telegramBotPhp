<?php
namespace telegramBotApiPhp\Types;

/**
 * Class KeyboardButtonRequestUsers
 * This object defines the criteria used to request suitable users.
 * Information about the selected users will be shared with the bot when the corresponding button is pressed.
 *
 * @property int $request_id Signed 32-bit identifier of the request that will be received back in the UsersShared object. Must be unique within the message.
 * @property bool $user_is_bot Optional. Pass True to request bots, pass False to request regular users. If not specified, no additional restrictions are applied.
 * @property bool $user_is_premium Optional. Pass True to request premium users, pass False to request non-premium users. If not specified, no additional restrictions are applied.
 * @property int $max_quantity Optional. The maximum number of users to be selected; 1-10. Defaults to 1.
 * @property bool $request_name Optional. Pass True to request the users' first and last names.
 * @property bool $request_username Optional. Pass True to request the users' usernames.
 * @property bool $request_photo Optional. Pass True to request the users' photos.
 */
class KeyboardButtonRequestUsers extends BaseType
{
}
