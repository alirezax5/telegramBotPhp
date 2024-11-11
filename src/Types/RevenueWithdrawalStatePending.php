<?php


namespace telegramBotApiPhp\Types;

/**
 * Class RevenueWithdrawalStatePending
 * @package telegramBotApiPhp\Types
 * @method string getType()
 * @method boolean issetType()
 */
class RevenueWithdrawalStatePending extends base
{
    static protected $map = [
        'type' => true,
    ];
    protected $Type;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}