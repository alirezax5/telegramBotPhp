<?php


namespace telegramBotApiPhp\Types;


/**
 * Class MenuButton
 * @package telegramBotApiPhp\Types
 * @method string getType()
 * @method string getText()
 * @method WebAppInfo getWebApp()
 * @method boolean issetType()
 * @method boolean issetText()
 * @method boolean issetWebApp()

 */
class MenuButton extends base
{
    static protected $map = [
        'type' => true,
        'text' => true,
        'web_app' => WebAppInfo::class,
    ];
    protected $Type;
    protected $Text;
    protected $WebApp;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}