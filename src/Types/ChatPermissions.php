<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ChatPermissions
 * Describes actions that a non-administrator user is allowed to take in a chat.
 *
 * @property bool $can_send_messages Optional. True, if the user is allowed to send text messages, contacts, giveaways, giveaway winners, invoices, locations, and venues.
 * @property bool $can_send_audios Optional. True, if the user is allowed to send audios.
 * @property bool $can_send_documents Optional. True, if the user is allowed to send documents.
 * @property bool $can_send_photos Optional. True, if the user is allowed to send photos.
 * @property bool $can_send_videos Optional. True, if the user is allowed to send videos.
 * @property bool $can_send_video_notes Optional. True, if the user is allowed to send video notes.
 * @property bool $can_send_voice_notes Optional. True, if the user is allowed to send voice notes.
 * @property bool $can_send_polls Optional. True, if the user is allowed to send polls.
 * @property bool $can_send_other_messages Optional. True, if the user is allowed to send animations, games, stickers, and use inline bots.
 * @property bool $can_add_web_page_previews Optional. True, if the user is allowed to add web page previews to their messages.
 * @property bool $can_change_info Optional. True, if the user is allowed to change the chat title, photo, and other settings. Ignored in public supergroups.
 * @property bool $can_invite_users Optional. True, if the user is allowed to invite new users to the chat.
 * @property bool $can_pin_messages Optional. True, if the user is allowed to pin messages. Ignored in public supergroups.
 * @property bool $can_manage_topics Optional. True, if the user is allowed to create forum topics. Defaults to the value of can_pin_messages if omitted.
 */
class ChatPermissions extends BaseType
{
}
