<?php
namespace telegramBotApiPhp\Types;

/**
 * Class KeyboardButton
 * Represents one button of the reply keyboard.
 * At most one of the optional fields must be used to specify type of the button.
 * For simple text buttons, String can be used instead of this object to specify the button text.
 *
 * @property string $text Text of the button. If none of the optional fields are used, it will be sent as a message when the button is pressed.
 * @property KeyboardButtonRequestUsers $request_users Optional. If specified, pressing the button will open a list of suitable users.
 *                                                     Identifiers of selected users will be sent to the bot in a “users_shared” service message. Available in private chats only.
 * @property KeyboardButtonRequestChat $request_chat Optional. If specified, pressing the button will open a list of suitable chats.
 *                                                    Tapping on a chat will send its identifier to the bot in a “chat_shared” service message. Available in private chats only.
 * @property bool $request_contact Optional. If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only.
 * @property bool $request_location Optional. If True, the user's current location will be sent when the button is pressed. Available in private chats only.
 * @property KeyboardButtonPollType $request_poll Optional. If specified, the user will be asked to create a poll and send it to the bot when the button is pressed. Available in private chats only.
 * @property WebAppInfo $web_app Optional. If specified, the described Web App will be launched when the button is pressed.
 *                               The Web App will be able to send a “web_app_data” service message. Available in private chats only.
 */
class KeyboardButton extends BaseType
{
}
