<?php


namespace telegramBotApiPhp\Types;

/**
 * Class ChatMemberAdministrator
 * Represents a chat member that has some additional privileges.
 *
 * @property User $user Information about the user.
 * @property string $status The member's status, always "administrator".
 * @property string|null $custom_title Custom title for this user.
 * @property bool $is_anonymous True if the user's presence in the chat is hidden.
 * @property bool $can_be_edited True if the bot can edit administrator privileges.
 * @property bool|null $can_post_messages True if the user can post messages (channels only).
 * @property bool|null $can_edit_messages True if the user can edit messages (channels only).
 * @property bool|null $can_delete_messages True if the user can delete messages.
 * @property bool|null $can_restrict_members True if the user can restrict members.
 * @property bool|null $can_promote_members True if the user can promote members.
 * @property bool|null $can_change_info True if the user can change chat info.
 * @property bool|null $can_invite_users True if the user can invite users.
 * @property bool|null $can_pin_messages True if the user can pin messages.
 * @property bool|null $can_manage_topics True if the user can manage topics.
 * @property bool|null $can_manage_chat True if the user can manage the chat.
 * @property bool|null $can_manage_video_chats True if the user can manage video chats.
 * @property bool|null $is_member True if the user is a member of the chat.
 * @property bool|null $can_send_messages True if the user can send messages.
 * @property bool|null $can_send_audios True if the user can send audios.
 * @property bool|null $can_send_documents True if the user can send documents.
 * @property bool|null $can_send_photos True if the user can send photos.
 * @property bool|null $can_send_videos True if the user can send videos.
 * @property bool|null $can_send_video_notes True if the user can send video notes.
 * @property bool|null $can_send_voice_notes True if the user can send voice notes.
 * @property bool|null $can_send_polls True if the user can send polls.
 * @property bool|null $can_send_other_messages True if the user can send other messages.
 * @property bool|null $can_add_web_page_previews True if the user can add web page previews.
 * @property int|null $until_date Date when restrictions will be lifted.
 */
class ChatMemberAdministrator extends BaseType
{

}
