<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ChatFullInfo
 * Contains full information about a chat.
 *
 * @property int $id Unique identifier for this chat. This number may have more than 32 significant bits.
 * @property string $type Type of the chat, can be either “private”, “group”, “supergroup” or “channel”.
 * @property string $title Optional. Title, for supergroups, channels, and group chats.
 * @property string $username Optional. Username, for private chats, supergroups, and channels if available.
 * @property string $first_name Optional. First name of the other party in a private chat.
 * @property string $last_name Optional. Last name of the other party in a private chat.
 * @property bool $is_forum Optional. True, if the supergroup chat is a forum (has topics enabled).
 * @property int $accent_color_id Optional. Identifier of the accent color for the chat name and backgrounds.
 * @property int $max_reaction_count Optional. The maximum number of reactions that can be set on a message.
 * @property ChatPhoto $photo Optional. Chat photo.
 * @property array $active_usernames Optional. List of all active chat usernames.
 * @property Birthdate $birthdate Optional. For private chats, the date of birth of the user.
 * @property BusinessIntro $business_intro Optional. For private chats with business accounts, the intro of the business.
 * @property BusinessLocation $business_location Optional. For private chats with business accounts, the location of the business.
 * @property BusinessOpeningHours $business_opening_hours Optional. For private chats with business accounts, the opening hours of the business.
 * @property Chat $personal_chat Optional. For private chats, the personal channel of the user.
 * @property array $available_reactions Optional. List of available reactions allowed in the chat.
 * @property string $background_custom_emoji_id Optional. Custom emoji identifier of the emoji chosen by the chat.
 * @property int $profile_accent_color_id Optional. Identifier of the accent color for the chat's profile background.
 * @property string $profile_background_custom_emoji_id Optional. Custom emoji identifier of the emoji chosen by the chat for its profile background.
 * @property string $emoji_status_custom_emoji_id Optional. Custom emoji identifier of the emoji status.
 * @property int $emoji_status_expiration_date Optional. Expiration date of the emoji status in Unix time.
 * @property string $bio Optional. Bio of the other party in a private chat.
 * @property bool $has_private_forwards Optional. True, if privacy settings allow using tg://user?id=<user_id> links.
 * @property bool $has_restricted_voice_and_video_messages Optional. True, if privacy settings restrict sending voice and video notes.
 * @property bool $join_to_send_messages Optional. True, if users need to join the supergroup before they can send messages.
 * @property bool $join_by_request Optional. True, if users directly joining the supergroup need approval.
 * @property string $description Optional. Description, for groups, supergroups, and channel chats.
 * @property string $invite_link Optional. Primary invite link, for groups, supergroups, and channel chats.
 * @property Message $pinned_message Optional. The most recent pinned message.
 * @property ChatPermissions $permissions Optional. Default chat member permissions for groups and supergroups.
 * @property bool $can_send_gift Optional. True, if gifts can be sent to the chat.
 * @property bool $can_send_paid_media Optional. True, if paid media messages can be sent or forwarded to the channel chat.
 * @property int $slow_mode_delay Optional. For supergroups, the minimum allowed delay between consecutive messages.
 * @property int $unrestrict_boost_count Optional. For supergroups, the minimum number of boosts required to ignore slow mode.
 * @property int $message_auto_delete_time Optional. The time after which all messages will be automatically deleted.
 * @property bool $has_aggressive_anti_spam_enabled Optional. True, if aggressive anti-spam checks are enabled.
 * @property bool $has_hidden_members Optional. True, if non-administrators can only get the list of bots and admins.
 * @property bool $has_protected_content Optional. True, if messages from the chat can't be forwarded.
 * @property bool $has_visible_history Optional. True, if new chat members will have access to old messages.
 * @property string $sticker_set_name Optional. Name of the group sticker set for supergroups.
 * @property bool $can_set_sticker_set Optional. True, if the bot can change the group sticker set.
 * @property string $custom_emoji_sticker_set_name Optional. Name of the group's custom emoji sticker set.
 * @property int $linked_chat_id Optional. Unique identifier for the linked chat, for supergroups and channel chats.
 * @property ChatLocation $location Optional. For supergroups, the location to which the supergroup is connected.
 */
class ChatFullInfo extends BaseType
{
}
