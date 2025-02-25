<?php
namespace telegramBotApiPhp\Types;

/**
 * Class SwitchInlineQueryChosenChat
 * Represents an inline button that switches the current user to inline mode in a chosen chat, with an optional default inline query.
 *
 * @property string $query Optional. The default inline query to be inserted in the input field. If left empty, only the bot's username will be inserted.
 * @property bool $allow_user_chats Optional. True, if private chats with users can be chosen.
 * @property bool $allow_bot_chats Optional. True, if private chats with bots can be chosen.
 * @property bool $allow_group_chats Optional. True, if group and supergroup chats can be chosen.
 * @property bool $allow_channel_chats Optional. True, if channel chats can be chosen.
 */
class SwitchInlineQueryChosenChat extends BaseType
{
}
