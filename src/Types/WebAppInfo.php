<?php


namespace telegramBotApiPhp\Types;


/**
 * Class WebAppInfo
 * @package telegramBotApiPhp\Types
 * @method string getUrl()
 * @method isset issetUrl()
 */
class WebAppInfo extends base
{
    static protected $map = [
        'url' => true,

    ];
    protected $Url;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}