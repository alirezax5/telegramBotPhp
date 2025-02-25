<?php
namespace telegramBotApiPhp\Types;

/**
 * Class UsersShared
 * Contains information about the users whose identifiers were shared with the bot using a KeyboardButtonRequestUsers button.
 *
 * @property int $request_id Identifier of the request.
 * @property SharedUser[] $users Information about users shared with the bot.
 */
class UsersShared extends BaseType
{
}
