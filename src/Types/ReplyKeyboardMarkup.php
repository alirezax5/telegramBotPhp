<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ReplyKeyboardMarkup
 * Represents a custom keyboard with reply options (see Introduction to bots for details and examples).
 * Not supported in channels and for messages sent on behalf of a Telegram Business account.
 *
 * @property array $keyboard Array of button rows, each represented by an Array of KeyboardButton objects.
 * @property bool $is_persistent Optional. Requests clients to always show the keyboard when the regular keyboard is hidden. Defaults to false,
 *                               in which case the custom keyboard can be hidden and opened with a keyboard icon.
 * @property bool $resize_keyboard Optional. Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false,
 *                                 in which case the custom keyboard is always of the same height as the app's standard keyboard.
 * @property bool $one_time_keyboard Optional. Requests clients to hide the keyboard as soon as it's been used. The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat.
 *                                  Defaults to false.
 * @property string $input_field_placeholder Optional. The placeholder to be shown in the input field when the keyboard is active; 1-64 characters.
 * @property bool $selective Optional. Use this parameter if you want to show the keyboard to specific users only. Targets:
 *                           1) users that are @mentioned in the text of the Message object;
 *                           2) if the bot's message is a reply to a message in the same chat and forum topic, sender of the original message.
 */
class ReplyKeyboardMarkup extends BaseType
{
}
