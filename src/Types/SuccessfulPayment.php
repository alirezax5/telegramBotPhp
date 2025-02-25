<?php
namespace telegramBotApiPhp\Types;

/**
 * Class SuccessfulPayment
 * Contains basic information about a successful payment.
 * Note: If the buyer initiates a chargeback, the funds may be debited from your balance, which is outside of Telegram's control.
 *
 * @property string $currency Three-letter ISO 4217 currency code, or “XTR” for Telegram Stars payments.
 * @property int $total_amount Total price in the smallest units of the currency (integer, not float/double).
 * @property string $invoice_payload Bot-specified invoice payload.
 * @property int|null $subscription_expiration_date Optional. Expiration date of the subscription (Unix time).
 * @property bool|null $is_recurring Optional. True if this is a recurring payment for a subscription.
 * @property bool|null $is_first_recurring Optional. True if this is the first payment for a subscription.
 * @property string|null $shipping_option_id Optional. Identifier of the shipping option chosen by the user.
 * @property OrderInfo|null $order_info Optional. Order information provided by the user.
 * @property string $telegram_payment_charge_id Telegram payment identifier.
 * @property string $provider_payment_charge_id Provider payment identifier.
 */
class SuccessfulPayment extends BaseType
{
}
