<?php

namespace telegramBotApiPhp\Types;

/**
 * Class Message
 *
 * This object represents a message.
 *
 * @property int $message_id Unique message identifier inside this chat.
 * @property int|null $message_thread_id Unique identifier of a message thread to which the message belongs (optional).
 * @property User|null $from Sender of the message (optional).
 * @property Chat|null $sender_chat Sender of the message when sent on behalf of a chat (optional).
 * @property int $date Date the message was sent in Unix time.
 * @property string|null $business_connection_id Unique identifier of the business connection from which the message was received (optional).
 * @property Chat $chat Chat the message belongs to.
 * @property MessageOrigin|null $forward_origin Information about the original message for forwarded messages (optional).
 * @property bool|null $is_topic_message True if the message is sent to a forum topic (optional).
 * @property bool|null $is_automatic_forward True if the message is a channel post automatically forwarded to a discussion group (optional).
 * @property Message|null $reply_to_message For replies in the same chat and message thread, the original message (optional).
 * @property ExternalReplyInfo|null $external_reply Information about the message being replied to (optional).
 * @property string|null $quote Quoted part of the original message (optional).
 * @property User|null $via_bot Bot through which the message was sent (optional).
 * @property int|null $edit_date Date the message was last edited in Unix time (optional).
 * @property bool|null $has_protected_content True if the message can't be forwarded (optional).
 * @property bool|null $is_from_offline True if the message was sent by an implicit action (optional).
 * @property string|null $media_group_id Unique identifier of the media message group this message belongs to (optional).
 * @property string|null $author_signature Signature of the post author for messages in channels (optional).
 * @property string|null $text The text of the message (optional).
 * @property MessageEntity[]|null $entities Special entities like usernames, URLs, bot commands, etc. in the text (optional).
 * @property LinkPreviewOptions|null $link_preview_options Options used for link preview generation (optional).
 * @property string|null $effect_id Unique identifier of the message effect (optional).
 * @property Animation|null $animation Message is an animation (optional).
 * @property Audio|null $audio Message is an audio file (optional).
 * @property Document|null $document Message is a general file (optional).
 * @property PaidMediaInfo|null $paid_media Message contains paid media (optional).
 * @property PhotoSize[]|null $photo Available sizes of the photo (optional).
 * @property Sticker|null $sticker Message is a sticker (optional).
 * @property Video|null $video Message is a video (optional).
 * @property VideoNote|null $video_note Message is a video note (optional).
 * @property Voice|null $voice Message is a voice message (optional).
 * @property string|null $caption Caption for media (optional).
 * @property MessageEntity[]|null $caption_entities Special entities in the caption (optional).
 * @property bool|null $show_caption_above_media True if the caption must be shown above the media (optional).
 * @property bool|null $has_media_spoiler True if the media is covered by a spoiler (optional).
 * @property Contact|null $contact Message is a shared contact (optional).
 * @property Dice|null $dice Message is a dice with random value (optional).
 * @property Game|null $game Message is a game (optional).
 * @property Poll|null $poll Message is a native poll (optional).
 * @property Venue|null $venue Message is a venue (optional).
 * @property Location|null $location Message is a shared location (optional).
 * @property User[]|null $new_chat_members New members added to the group or supergroup (optional).
 * @property User|null $left_chat_member Member removed from the group (optional).
 * @property string|null $new_chat_title New chat title (optional).
 * @property PhotoSize[]|null $new_chat_photo New chat photo (optional).
 * @property bool|null $delete_chat_photo True if the chat photo was deleted (optional).
 * @property bool|null $group_chat_created True if the group has been created (optional).
 * @property bool|null $supergroup_chat_created True if the supergroup has been created (optional).
 * @property bool|null $channel_chat_created True if the channel has been created (optional).
 * @property MessageAutoDeleteTimerChanged|null $message_auto_delete_timer_changed Auto-delete timer settings changed (optional).
 * @property int|null $migrate_to_chat_id The group migrated to a supergroup (optional).
 * @property int|null $migrate_from_chat_id The supergroup migrated from a group (optional).
 * @property MaybeInaccessibleMessage|null $pinned_message Specified message was pinned (optional).
 * @property Invoice|null $invoice Message is an invoice (optional).
 * @property SuccessfulPayment|null $successful_payment Message is about a successful payment (optional).
 * @property RefundedPayment|null $refunded_payment Message is about a refunded payment (optional).
 * @property UsersShared|null $users_shared Service message: users were shared with the bot (optional).
 * @property ChatShared|null $chat_shared Service message: a chat was shared with the bot (optional).
 * @property string|null $connected_website The domain name of the website on which the user has logged in (optional).
 * @property WriteAccessAllowed|null $write_access_allowed Service message: the user allowed the bot to write messages (optional).
 * @property PassportData|null $passport_data Telegram Passport data (optional).
 * @property ProximityAlertTriggered|null $proximity_alert_triggered Service message: user triggered another user's proximity alert (optional).
 * @property ChatBoostAdded|null $boost_added Service message: user boosted the chat (optional).
 * @property ChatBackground|null $chat_background_set Service message: chat background set (optional).
 * @property ForumTopicCreated|null $forum_topic_created Service message: forum topic created (optional).
 * @property ForumTopicEdited|null $forum_topic_edited Service message: forum topic edited (optional).
 * @property ForumTopicClosed|null $forum_topic_closed Service message: forum topic closed (optional).
 * @property ForumTopicReopened|null $forum_topic_reopened Service message: forum topic reopened (optional).
 * @property GeneralForumTopicHidden|null $general_forum_topic_hidden Service message: general forum topic hidden (optional).
 * @property GeneralForumTopicUnhidden|null $general_forum_topic_unhidden Service message: general forum topic unhidden (optional).
 * @property GiveawayCreated|null $giveaway_created Service message: scheduled giveaway created (optional).
 * @property Giveaway|null $giveaway Service message: scheduled giveaway message (optional).
 * @property GiveawayWinners|null $giveaway_winners Service message: giveaway completed (optional).
 * @property GiveawayCompleted|null $giveaway_completed Service message: giveaway completed without public winners (optional).
 * @property VideoChatScheduled|null $video_chat_scheduled Service message: video chat scheduled (optional).
 * @property VideoChatStarted|null $video_chat_started Service message: video chat started (optional).
 * @property VideoChatEnded|null $video_chat_ended Service message: video chat ended (optional).
 * @property VideoChatParticipantsInvited|null $video_chat_participants_invited Service message: new participants invited to a video chat (optional).
 * @property WebAppData|null $web_app_data Service message: data sent by a Web App (optional).
 * @property InlineKeyboardMarkup|null $reply_markup Inline keyboard attached to the message (optional).
 */
class Message extends BaseType
{

}
