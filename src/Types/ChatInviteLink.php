<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ChatInviteLink
 * Represents an invite link for a chat with various properties regarding its status and limitations.
 *
 * @property string $invite_link The invite link
 * @property User $creator Creator of the link
 * @property bool $creates_join_request True if users joining need approval from chat admins
 * @property bool $is_primary True if the link is primary
 * @property bool $is_revoked True if the link is revoked
 * @property string $name Optional. Invite link name
 * @property int $expire_date Optional. Expiry timestamp of the link
 * @property int $member_limit Optional. Max number of members allowed via this link
 * @property int $pending_join_request_count Optional. Number of pending join requests
 * @property int $subscription_period Optional. Subscription period duration in seconds
 * @property int $subscription_price Optional. Price in Telegram Stars for subscription
 */
class ChatInviteLink extends BaseType
{
}
