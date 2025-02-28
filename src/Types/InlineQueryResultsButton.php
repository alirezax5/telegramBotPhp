<?php
namespace telegramBotApiPhp\Types;

/**
 * Class InlineQueryResultsButton
 * Represents a button to be shown above inline query results.
 *
 * @property string $text Label text on the button
 * @property WebAppInfo|null $web_app Optional. Description of the Web App that will be launched when the user presses the button.
 * @property string|null $start_parameter Optional. Deep-linking parameter for the /start message sent to the bot when a user presses the button.
 */
class InlineQueryResultsButton extends BaseType
{
}
