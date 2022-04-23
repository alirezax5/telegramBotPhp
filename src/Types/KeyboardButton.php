<?php


namespace telegramBotApiPhp\Types;


/**
 * Class KeyboardButton
 * @package telegramBotApiPhp\Types
 * @method string getText()
 * @method Boolean getRequestContact()
 * @method Boolean getRequestLocation()
 * @method KeyboardButtonPollType getRequestPoll()
 * @method WebAppInfo getWebApp()
 * @method boolean issetText()
 * @method boolean issetRequestContact()
 * @method boolean issetRequestLocation()
 * @method boolean issetRequestPoll()
 * @method boolean issetWebApp()

 */
class KeyboardButton extends base
{
    static protected $map = [
        'text' => true,
        'request_contact' => true,
        'request_location' => true,
        'request_poll' => KeyboardButtonPollType::class,
        'web_app' => WebAppInfo::class,
    ];
    protected $Text;
    protected $RequestContact;
    protected $RequestLocation;
    protected $RequestPoll;
    protected $WebApp;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}