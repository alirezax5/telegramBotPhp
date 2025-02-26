<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ChatMember
 * This object contains information about one member of a chat.
 *
 * @property string $status The member's status in the chat (e.g., "creator", "administrator", "member", "restricted").
 * @property User $user Information about the user.
 * @property bool|null $is_anonymous True if the user's presence in the chat is hidden.
 * @property string|null $custom_title Custom title for this user, if any.
 * @property bool|null $can_be_edited True if the bot can edit administrator privileges of that user.
 * @property bool|null $can_manage_chat True if the administrator can access chat logs and manage events.
 * @property bool|null $can_delete_messages True if the administrator can delete messages of other users.
 * @property bool|null $can_manage_video_chats True if the administrator can manage video chats.
 * @property bool|null $can_restrict_members True if the administrator can restrict, ban, or unban members.
 * @property bool|null $can_promote_members True if the administrator can add new admins or demote them.
 * @property bool|null $can_change_info True if the user can change chat settings.
 * @property bool|null $can_invite_users True if the user can invite new members to the chat.
 * @property bool|null $can_post_stories True if the user can post stories.
 * @property bool|null $can_edit_stories True if the user can edit or pin stories.
 * @property bool|null $can_delete_stories True if the user can delete stories.
 * @property bool|null $can_post_messages True if the user can post messages (channels only).
 * @property bool|null $can_edit_messages True if the user can edit messages (channels only).
 * @property bool|null $can_pin_messages True if the user can pin messages.
 * @property bool|null $can_manage_topics True if the user can manage forum topics (supergroups only).
 * @property int|null $until_date The date when the user's subscription will expire or restrictions will be lifted (Unix time).
 * @property bool|null $is_member True if the user is a member of the chat.
 * @property bool|null $can_send_messages True if the user can send messages.
 * @property bool|null $can_send_audios True if the user can send audios.
 * @property bool|null $can_send_documents True if the user can send documents.
 * @property bool|null $can_send_photos True if the user can send photos.
 * @property bool|null $can_send_videos True if the user can send videos.
 * @property bool|null $can_send_video_notes True if the user can send video notes.
 * @property bool|null $can_send_voice_notes True if the user can send voice notes.
 * @property bool|null $can_send_polls True if the user can send polls.
 * @property bool|null $can_send_other_messages True if the user can send animations, games, stickers, etc.
 * @property bool|null $can_add_web_page_previews True if the user can add webpage previews to messages.
 */
class ChatMember extends BaseType
{
}
