<?php


namespace telegramBotApiPhp\Types;


/**
 * Class SuccessfulPayment
 * @package telegramBotApiPhp\Types
 * @method string getCurrency()
 * @method Integer getTotalAmount()
 * @method string getInvoicePayload()
 * @method string getTelegramPaymentChargeId()
 * @method string getProviderPaymentChargeId()
 */
class RefundedPayment extends base
{
    static protected $map = [
        'currency' => true,
        'total_amount' => true,
        'invoice_payload' => true,
        'telegram_payment_charge_id' => true,
        'provider_payment_charge_id' => true,
    ];

    protected $Currency;
    protected $TotalAmount;
    protected $InvoicePayload;
    protected $TelegramPaymentChargeId;
    protected $ProviderPaymentChargeId;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}