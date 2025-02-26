<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ChatAdministratorRights
 * Represents the rights of an administrator in a chat.
 *
 * @property bool $is_anonymous True, if the user's presence in the chat is hidden.
 * @property bool $can_manage_chat True, if the administrator can access the chat event log, get boost list, see hidden supergroup and channel members, report spam messages and ignore slow mode. Implied by any other administrator privilege.
 * @property bool $can_delete_messages True, if the administrator can delete messages of other users.
 * @property bool $can_manage_video_chats True, if the administrator can manage video chats.
 * @property bool $can_restrict_members True, if the administrator can restrict, ban or unban chat members, or access supergroup statistics.
 * @property bool $can_promote_members True, if the administrator can add new administrators with a subset of their own privileges or demote administrators that they have promoted, directly or indirectly (promoted by administrators that were appointed by the user).
 * @property bool $can_change_info True, if the user is allowed to change the chat title, photo and other settings.
 * @property bool $can_invite_users True, if the user is allowed to invite new users to the chat.
 * @property bool $can_post_stories True, if the administrator can post stories to the chat.
 * @property bool $can_edit_stories True, if the administrator can edit stories posted by other users, post stories to the chat page, pin chat stories, and access the chat's story archive.
 * @property bool $can_delete_stories True, if the administrator can delete stories posted by other users.
 * @property bool $can_post_messages Optional. True, if the administrator can post messages in the channel, or access channel statistics; for channels only.
 * @property bool $can_edit_messages Optional. True, if the administrator can edit messages of other users and can pin messages; for channels only.
 * @property bool $can_pin_messages Optional. True, if the user is allowed to pin messages; for groups and supergroups only.
 * @property bool $can_manage_topics Optional. True, if the user is allowed to create, rename, close, and reopen forum topics; for supergroups only.
 */
class ChatAdministratorRights extends BaseType
{
}
