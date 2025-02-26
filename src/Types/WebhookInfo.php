<?php
namespace telegramBotApiPhp\Types;

/**
 * Class WebhookInfo
 * Describes the current status of a webhook.
 *
 * @property string $url Webhook URL, may be empty if not set up
 * @property bool $has_custom_certificate True if a custom certificate is used
 * @property int $pending_update_count Number of updates awaiting delivery
 * @property string $ip_address Optional. Current webhook IP address
 * @property int $last_error_date Optional. Timestamp of the last error while delivering an update
 * @property string $last_error_message Optional. Error message for the last delivery issue
 * @property int $last_synchronization_error_date Optional. Timestamp of the last synchronization error
 * @property int $max_connections Optional. Max allowed number of simultaneous connections for update delivery
 * @property string[] $allowed_updates Optional. List of update types the bot is subscribed to
 */
class WebhookInfo extends BaseType
{
}
