<?php
namespace telegramBotApiPhp\Types;

/**
 * Class OrderInfo
 * Represents information about an order.
 *
 * @property string|null $name Optional. User name.
 * @property string|null $phone_number Optional. User's phone number.
 * @property string|null $email Optional. User email.
 * @property ShippingAddress|null $shipping_address Optional. User shipping address.
 */
class OrderInfo extends BaseType
{
}
