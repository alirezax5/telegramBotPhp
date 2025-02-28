<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ShippingQuery
 * This object contains information about an incoming shipping query.
 *
 * @property string $id Unique query identifier
 * @property User $from User who sent the query
 * @property string $invoice_payload Bot-specified invoice payload
 * @property ShippingAddress $shipping_address User specified shipping address
 */
class ShippingQuery extends BaseType
{
}
