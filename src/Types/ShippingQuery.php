<?php


namespace telegramBotApiPhp\Types;

/**
 * Class ShippingQuery
 * @package telegramBotApiPhp\Types
 * @method string getId()
 * @method User getFrom()
 * @method string getInvoicePayload()
 * @method ShippingAddress getShippingAddress()
 */
class ShippingQuery extends base
{
    static protected $map = [
        'id' => true,
        'from' => User::class,
        'invoice_payload' => true,
        'shipping_address' => ShippingAddress::class,
    ];
    protected $Id;
    protected $From;
    protected $InvoicePayload;
    protected $ShippingAddress;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}