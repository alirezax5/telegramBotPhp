<?php


namespace telegramBotApiPhp\Types;

/**
 * Class PreCheckoutQuery
 * @package telegramBotApiPhp\Types
 * @method string getId()
 * @method User getFrom()
 * @method string getCurrency()
 * @method int getTotalAmount()
 * @method string getInvoicePayload()
 * @method string getShippingOptionId()
 * @method OrderInfo getOrderInfo()
 */
class PreCheckoutQuery extends base
{
    static protected $map = [
        'id' => true,
        'from' => User::class,
        'currency' => true,
        'total_amount' => true,
        'invoice_payload' => true,
        'shipping_option_id' => true,
        'order_info' => OrderInfo::class,
    ];
    protected $Id;
    protected $From;
    protected $Currency;
    protected $TotalAmount;
    protected $InvoicePayload;
    protected $ShippingOptionId;
    protected $OrderInfo;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}