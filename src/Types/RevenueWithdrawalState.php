<?php


namespace telegramBotApiPhp\Types;

/**
 * Class RevenueWithdrawalState
 * @package telegramBotApiPhp\Types
 * @method string getType()
 * @method string getDate()
 * @method string getUrl()
 * @method boolean issetType()
 * @method boolean issetDate()
 * @method boolean issetUrl()
 */
class RevenueWithdrawalState extends base
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