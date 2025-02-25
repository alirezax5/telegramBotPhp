<?php
namespace telegramBotApiPhp\Types;

/**
 * Class WebAppData
 * Describes data sent from a Web App to the bot.
 *
 * @property string $data The data. Be aware that a bad client can send arbitrary data in this field.
 * @property string $button_text Text of the web_app keyboard button from which the Web App was opened.
 *                               Be aware that a bad client can send arbitrary data in this field.
 */
class WebAppData extends BaseType
{
}
