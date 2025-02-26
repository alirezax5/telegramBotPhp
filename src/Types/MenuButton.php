<?php
namespace telegramBotApiPhp\Types;

/**
 * Class MenuButton
 * Represents a menu button that triggers a Web App.
 *
 * @property string $type Type of the button (must be "web_app")
 * @property string $text Text on the button
 * @property WebAppInfo $web_app Description of the Web App to be launched
 */
class MenuButton extends BaseType
{
}
