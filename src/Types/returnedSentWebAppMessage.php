<?php


namespace telegramBotApiPhp\Types;

/**
 * Class returned
 * @package telegramBotApiPhp\Types
 * @method bool getSentWebAppMessage()
 * @method bool issetSentWebAppMessage()

 */
class returnedSentWebAppMessage extends base
{
    static protected $map = [
        'SentWebAppMessage' => true,
    ];

    protected $SentWebAppMessage;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}