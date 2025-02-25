<?php
namespace telegramBotApiPhp\Types;

/**
 * Class InlineKeyboardButton
 * Represents one button of an inline keyboard. Exactly one of the optional fields must be used to specify type of the button.
 *
 * @property string $text Label text on the button.
 * @property string $url Optional. HTTP or tg:// URL to be opened when the button is pressed.
 * @property string $callback_data Optional. Data to be sent in a callback query to the bot when the button is pressed, 1-64 bytes.
 * @property WebAppInfo $web_app Optional. Description of the Web App that will be launched when the user presses the button.
 * @property LoginUrl $login_url Optional. An HTTPS URL used to automatically authorize the user.
 * @property string $switch_inline_query Optional. If set, pressing the button will prompt the user to select one of their chats and insert the bot's username and the specified inline query.
 * @property string $switch_inline_query_current_chat Optional. If set, pressing the button will insert the bot's username and the specified inline query in the current chat's input field.
 * @property SwitchInlineQueryChosenChat $switch_inline_query_chosen_chat Optional. If set, pressing the button will prompt the user to select one of their chats of the specified type.
 * @property CopyTextButton $copy_text Optional. Description of the button that copies the specified text to the clipboard.
 * @property CallbackGame $callback_game Optional. Description of the game that will be launched when the user presses the button.
 * @property bool $pay Optional. Specify True to send a Pay button.
 */
class InlineKeyboardButton extends BaseType
{
}
