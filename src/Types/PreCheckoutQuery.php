<?php
namespace telegramBotApiPhp\Types;

/**
 * Class PreCheckoutQuery
 * This object contains information about an incoming pre-checkout query.
 *
 * @property string $id Unique query identifier
 * @property User $from User who sent the query
 * @property string $currency Three-letter ISO 4217 currency code, or “XTR” for payments in Telegram Stars
 * @property int $total_amount Total price in the smallest units of the currency (integer, not float/double)
 * @property string $invoice_payload Bot-specified invoice payload
 * @property string|null $shipping_option_id Optional. Identifier of the shipping option chosen by the user
 * @property OrderInfo|null $order_info Optional. Order information provided by the user
 */
class PreCheckoutQuery extends BaseType
{
}
