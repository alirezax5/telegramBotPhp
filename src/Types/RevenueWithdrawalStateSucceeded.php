<?php


namespace telegramBotApiPhp\Types;

/**
 * Class RevenueWithdrawalStateSucceeded
 * @package telegramBotApiPhp\Types
 * @method string getType()
 * @method string getDate()
 * @method string getUrl()
 * @method bool issetType()
 * @method bool issetDate()
 * @method bool issetUrl()
 */
class RevenueWithdrawalStateSucceeded extends base
{
    static protected $map = [
        'type' => true,
        'date' => true,
        'url' => true,
    ];
    protected $Type;
    protected $Date;
    protected $Url;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}