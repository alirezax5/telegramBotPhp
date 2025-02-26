<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ForceReply
 * Upon receiving a message with this object, Telegram clients will display a reply interface to the user.
 * This can be extremely useful for creating user-friendly step-by-step interfaces without sacrificing privacy mode.
 * Not supported in channels and for messages sent on behalf of a Telegram Business account.
 *
 * @property bool $force_reply Shows reply interface to the user.
 * @property string|null $input_field_placeholder Optional. Placeholder for the input field when the reply is active.
 * @property bool|null $selective Optional. Force reply from specific users only.
 */
class ForceReply extends BaseType
{
}
