<?php


namespace telegramBotApiPhp\Types;


/**
 * Class PaidMediaPurchased
 * @package telegramBotApiPhp\Types
 * @method User getFrom()
 * @method string getPaidMediaPayload()
 * @method boolean issetFrom()
 * @method boolean issetPaidMediaPayload()
 */
class PaidMediaPurchased extends base
{
    static protected $map = [
        'from' => User::class,
        'paid_media_payload' => true,
    ];

    protected $From;
    protected $PaidMediaPayload;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}