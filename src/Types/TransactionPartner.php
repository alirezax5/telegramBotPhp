<?php


namespace telegramBotApiPhp\Types;


/**
 * Class TransactionPartner
 * @package telegramBotApiPhp\Types
 * @method string getType()
 * @method User getUser()
 * @method string getInvoicePayload()
 * @method ArrayOfPaidMedia getPaidMedia()
 * @method string getPaidMediaPayload()
 * @method RevenueWithdrawalState getWithdrawalState()
 * @method string getRequestCount()
 * @method boolean issetType()
 * @method boolean issetUser()
 * @method boolean issetInvoicePayload()
 * @method boolean issetPaidMedia()
 * @method boolean issetPaidMediaPayload()
 * @method boolean issetWithdrawalState()
 * @method boolean issetRequestCount()
 */
class TransactionPartner extends base
{
    static protected $map = [
        'type' => true,
        'user' => User::class,
        'invoice_payload' => true,
        'paid_media' => ArrayOfPaidMedia::class,
        'paid_media_payload' => true,
        'withdrawal_state' => RevenueWithdrawalState::class,
        'request_count' => true,
    ];

    protected $Type;
    protected $User;
    protected $InvoicePayload;
    protected $PaidMedia;
    protected $PaidMediaPayload;
    protected $WithdrawalState;
    protected $RequestCount;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}