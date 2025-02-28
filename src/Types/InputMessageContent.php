<?php
namespace telegramBotApiPhp\Types;

/**
 * Class InputMessageContent
 * This object represents the content of a message to be sent as a result of an inline query.
 *
 * Telegram clients currently support the following 5 types:
 *
 * @property string $message_text Text of the message to be sent, 1-4096 characters
 * @property string|null $parse_mode Optional. Mode for parsing entities in the message text. See formatting options for more details.
 * @property array|null $entities Optional. List of special entities that appear in message text, which can be specified instead of parse_mode
 * @property LinkPreviewOptions|null $link_preview_options Optional. Link preview generation options for the message
 * @property float|null $latitude Optional. Latitude of the location in degrees
 * @property float|null $longitude Optional. Longitude of the location in degrees
 * @property float|null $horizontal_accuracy Optional. The radius of uncertainty for the location, measured in meters; 0-1500
 * @property int|null $live_period Optional. Period in seconds during which the location can be updated, should be between 60 and 86400, or 0x7FFFFFFF for live locations that can be edited indefinitely.
 * @property int|null $heading Optional. For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified.
 * @property int|null $proximity_alert_radius Optional. For live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
 * @property string|null $title Optional. Name of the venue
 * @property string|null $address Optional. Address of the venue
 * @property string|null $foursquare_id Optional. Foursquare identifier of the venue, if known
 * @property string|null $foursquare_type Optional. Foursquare type of the venue, if known
 * @property string|null $google_place_id Optional. Google Places identifier of the venue
 * @property string|null $google_place_type Optional. Google Places type of the venue
 * @property string|null $phone_number Optional. Contact's phone number
 * @property string|null $first_name Optional. Contact's first name
 * @property string|null $last_name Optional. Contact's last name
 * @property string|null $vcard Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes
 * @property string|null $product_title Optional. Product name, 1-32 characters
 * @property string|null $product_description Optional. Product description, 1-255 characters
 * @property string|null $payload Optional. Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use it for your internal processes.
 * @property string|null $provider_token Optional. Payment provider token, obtained via @BotFather. Pass an empty string for payments in Telegram Stars.
 * @property string|null $currency Optional. Three-letter ISO 4217 currency code, see more on currencies. Pass “XTR” for payments in Telegram Stars.
 * @property array|null $prices Optional. Price breakdown, a JSON-serialized list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.). Must contain exactly one item for payments in Telegram Stars.
 * @property int|null $max_tip_amount Optional. The maximum accepted amount for tips in the smallest units of the currency (integer, not float/double).
 * @property array|null $suggested_tip_amounts Optional. A JSON-serialized array of suggested amounts of tip in the smallest units of the currency (integer, not float/double).
 * @property string|null $provider_data Optional. A JSON-serialized object for data about the invoice, which will be shared with the payment provider.
 * @property string|null $photo_url Optional. URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service.
 * @property int|null $photo_size Optional. Photo size in bytes
 * @property int|null $photo_width Optional. Photo width
 * @property int|null $photo_height Optional. Photo height
 * @property bool|null $need_name Optional. Pass True if you require the user's full name to complete the order.
 * @property bool|null $need_phone_number Optional. Pass True if you require the user's phone number to complete the order.
 * @property bool|null $need_email Optional. Pass True if you require the user's email address to complete the order.
 * @property bool|null $need_shipping_address Optional. Pass True if you require the user's shipping address to complete the order.
 * @property bool|null $send_phone_number_to_provider Optional. Pass True if the user's phone number should be sent to the provider.
 * @property bool|null $send_email_to_provider Optional. Pass True if the user's email address should be sent to the provider.
 * @property bool|null $is_flexible Optional. Pass True if the final price depends on the shipping method.
 */
class InputMessageContent extends BaseType
{
}
