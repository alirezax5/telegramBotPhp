<?php


namespace telegramBotApiPhp\Traits;


use telegramBotApiPhp\Types\{
    returned,
    returnedArrayOfSticker,
    returnedBotDescription,
    returnedBotName,
    returnedBotShortDescription,
    returnedChat,
    returnedChatInviteLink,
    returnedChatMember,
    returnedFile,
    returnedGifts,
    returnedInt,
    returnedMenuButton,
    returnedMessage,
    returnedMessageId,
    returnedStickerSet,
    returnedString,
    returnedUser,
    returnedUserProfilePhotos,
    returnedWebhookInfo,
    SentWebAppMessage,
    returnedStory
};

trait method
{

    // webhook Method
    /**
     * @return returnedMessage
     */
    public function getUpdates($offset = 0, int $limit = 10, $timeout = null, $allowed_updates = [])
    {
        return returnedMessage::create($this->bot('getUpdates', compact('offset', 'limit')));
    }

    /**
     * @return returned
     */
    public function setWebhook($url, $certificate = null, $ip_address = null, $max_connections = null, $allowed_updates = null, $drop_pending_updates = false, $secret_token = null)
    {
        return returned::create($this->bot('setWebhook', compact('url', 'certificate', 'ip_address', 'max_connections', 'allowed_updates', 'drop_pending_updates', 'secret_token')));
    }

    /**
     * @return returned
     */
    public function deleteWebhook($drop_pending_updates = false)
    {
        return returned::create($this->bot('deleteWebhook', compact('drop_pending_updates')));
    }

    /**
     * @return returnedWebhookInfo
     */
    public function getWebhookInfo()
    {
        return returnedWebhookInfo::create($this->bot('getWebhookInfo'));
    }

    /**
     * @return returnedUser
     */
    public function getMe()
    {
        return returnedUser::create($this->bot('getMe'));
    }

    /**
     * @return returned
     */
    public function logOut()
    {
        return returned::create($this->bot('logOut'));
    }

    /**
     * @return returned
     */
    public function close()
    {
        return returned::create($this->bot('close'));
    }

    /**
     * @return returnedMessage
     */
    public function sendMessage($chat_id, string $text, string $parse_mode = 'html', bool $disable_web_page_preview = false, $reply_markup = null, bool $disable_notification = false, bool $protect_content = false, ?int $reply_to_message_id = null, $entities = null, $allow_sending_without_reply = null, $allow_paid_broadcast = false, $business_connection_id = null)
    {
        return returnedMessage::create($this->bot('sendMessage', compact(
            'chat_id', 'text', 'parse_mode', 'disable_web_page_preview', 'reply_markup', 'disable_notification',
            'protect_content', 'reply_to_message_id', 'entities', 'allow_sending_without_reply', 'allow_paid_broadcast',
            'business_connection_id'
        )));
    }


    /**
     * @return returnedMessage
     */
    public function forwardMessage($chat_id, $from_chat_id, int $message_id, ?int $message_thread_id = null, ?int $video_start_timestamp = null, bool $disable_notification = false, bool $protect_content = false)
    {
        return returnedMessage::create($this->bot('forwardMessage', compact(
            'chat_id', 'from_chat_id', 'message_id', 'message_thread_id', 'video_start_timestamp',
            'disable_notification', 'protect_content'
        )));
    }


    /**
     * @return returnedMessageId
     */
    public function copyMessage($chat_id, $from_chat_id, int $message_id, $caption = null, $parse_mode = 'html', $reply_markup = null, bool $disable_notification = false, bool $protect_content = false, $reply_to_message_id = null, $allow_sending_without_reply = true)
    {
        return returnedMessageId::create($this->bot('copyMessage', compact('chat_id', 'from_chat_id', 'disable_notification', 'protect_content', 'message_id', 'reply_markup', 'caption', 'parse_mode', 'reply_to_message_id', 'allow_sending_without_reply')));
    }

    public function forwardMessages($chat_id, $from_chat_id, array $message_ids, ?int $message_thread_id = null, bool $disable_notification = false, bool $protect_content = false): returnedArrayOfMessageId
    {
        return returnedArrayOfMessageId::create($this->bot('forwardMessages', compact(
            'chat_id', 'from_chat_id', 'message_ids', 'message_thread_id', 'disable_notification', 'protect_content'
        )));
    }

    public function copyMessages($chat_id, $from_chat_id, array $message_ids, ?int $message_thread_id = null, bool $disable_notification = false, bool $protect_content = false, bool $remove_caption = false): returnedArrayOfMessageId
    {
        return returnedArrayOfMessageId::create($this->bot('copyMessages', compact(
            'chat_id', 'from_chat_id', 'message_ids', 'message_thread_id', 'disable_notification',
            'protect_content', 'remove_caption'
        )));
    }

    /**
     * @return returnedMessageId
     */
    public function copyMessageNonCaption($chat_id, $from_chat_id, int $message_id, $parse_mode = 'html', $reply_markup = null, bool $disable_notification = false, bool $protect_content = false, $reply_to_message_id = null, $allow_sending_without_reply = true)
    {
        return returnedMessageId::create($this->bot('copyMessage', compact('chat_id', 'from_chat_id', 'disable_notification', 'protect_content', 'message_id', 'reply_markup', 'parse_mode', 'reply_to_message_id', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedMessage
     */
    public function sendPhoto($chat_id, $photo, ?string $caption = null, ?string $parse_mode = null, $caption_entities = null, bool $show_caption_above_media = false, bool $has_spoiler = false, bool $disable_notification = false, bool $protect_content = false, bool $allow_paid_broadcast = false, ?string $business_connection_id = null, ?int $message_thread_id = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendPhoto', compact(
            'chat_id', 'photo', 'caption', 'parse_mode', 'caption_entities', 'show_caption_above_media',
            'has_spoiler', 'disable_notification', 'protect_content', 'allow_paid_broadcast',
            'business_connection_id', 'message_thread_id', 'reply_markup'
        )));
    }


    /**
     * @return returnedMessage
     */
    public function sendAudio($chat_id, $audio, ?string $caption = null, ?string $parse_mode = null, $caption_entities = null, ?int $duration = null, ?string $performer = null, ?string $title = null, $thumbnail = null, bool $disable_notification = false, bool $protect_content = false, bool $allow_paid_broadcast = false, ?string $business_connection_id = null, ?int $message_thread_id = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendAudio', compact(
            'chat_id', 'audio', 'caption', 'parse_mode', 'caption_entities', 'duration', 'performer',
            'title', 'thumbnail', 'disable_notification', 'protect_content', 'allow_paid_broadcast',
            'business_connection_id', 'message_thread_id', 'reply_markup'
        )));
    }


    /**
     * @return returnedMessage
     */
    public function sendDocument($chat_id, $document, ?string $caption = null, ?string $parse_mode = null, $caption_entities = null, bool $disable_content_type_detection = false, bool $disable_notification = false, bool $protect_content = false, bool $allow_paid_broadcast = false, ?string $business_connection_id = null, ?int $message_thread_id = null, $thumbnail = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendDocument', compact(
            'chat_id', 'document', 'caption', 'parse_mode', 'caption_entities', 'disable_content_type_detection',
            'disable_notification', 'protect_content', 'allow_paid_broadcast', 'business_connection_id',
            'message_thread_id', 'thumbnail', 'reply_markup'
        )));
    }


    /**
     * @return returnedMessage
     */
    public function sendVideo($chat_id, $video, ?string $caption = null, ?string $parse_mode = null, $caption_entities = null, bool $show_caption_above_media = false, bool $has_spoiler = false, bool $supports_streaming = false, bool $disable_notification = false, bool $protect_content = false, bool $allow_paid_broadcast = false, ?string $business_connection_id = null, ?int $message_thread_id = null, ?int $duration = null, ?int $width = null, ?int $height = null, $thumbnail = null, $cover = null, ?int $start_timestamp = null, ?string $message_effect_id = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendVideo', compact(
            'chat_id', 'video', 'caption', 'parse_mode', 'caption_entities', 'show_caption_above_media',
            'has_spoiler', 'supports_streaming', 'disable_notification', 'protect_content', 'allow_paid_broadcast',
            'business_connection_id', 'message_thread_id', 'duration', 'width', 'height', 'thumbnail', 'cover',
            'start_timestamp', 'message_effect_id', 'reply_markup'
        )));
    }


    /**
     * @return returnedMessage
     */
    public function sendAnimation($chat_id, $animation, ?string $caption = null, ?string $parse_mode = null, $caption_entities = null, bool $show_caption_above_media = false, bool $has_spoiler = false, bool $disable_notification = false, bool $protect_content = false, bool $allow_paid_broadcast = false, ?string $business_connection_id = null, ?int $message_thread_id = null, ?int $duration = null, ?int $width = null, ?int $height = null, $thumbnail = null, ?string $message_effect_id = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendAnimation', compact(
            'chat_id', 'animation', 'caption', 'parse_mode', 'caption_entities', 'show_caption_above_media',
            'has_spoiler', 'disable_notification', 'protect_content', 'allow_paid_broadcast',
            'business_connection_id', 'message_thread_id', 'duration', 'width', 'height', 'thumbnail',
            'message_effect_id', 'reply_markup'
        )));
    }

    /**
     * @return returnedMessage
     */
    public function sendVoice($chat_id, $voice, ?string $caption = null, ?string $parse_mode = null, $caption_entities = null, ?int $duration = null, bool $disable_notification = false, bool $protect_content = false, bool $allow_paid_broadcast = false, ?string $business_connection_id = null, ?int $message_thread_id = null, ?string $message_effect_id = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendVoice', compact(
            'chat_id', 'voice', 'caption', 'parse_mode', 'caption_entities', 'duration',
            'disable_notification', 'protect_content', 'allow_paid_broadcast',
            'business_connection_id', 'message_thread_id', 'message_effect_id', 'reply_markup'
        )));
    }


    /**
     * @return returnedMessage
     */
    public function sendVideoNote($chat_id, $video_note, ?int $duration = null, ?int $length = null, $thumbnail = null, bool $disable_notification = false, bool $protect_content = false, bool $allow_paid_broadcast = false, ?string $business_connection_id = null, ?int $message_thread_id = null, ?string $message_effect_id = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendVideoNote', compact(
            'chat_id', 'video_note', 'duration', 'length', 'thumbnail',
            'disable_notification', 'protect_content', 'allow_paid_broadcast',
            'business_connection_id', 'message_thread_id', 'message_effect_id', 'reply_markup'
        )));
    }

    /**
     * @return returnedMessage
     */
    public function sendPaidMedia($chat_id, int $star_count, array $media, ?string $payload = null, ?string $caption = null, ?string $parse_mode = null, ?array $caption_entities = null, bool $show_caption_above_media = false, bool $disable_notification = false, bool $protect_content = false, bool $allow_paid_broadcast = false, ?string $business_connection_id = null, $reply_markup = null, ?int $reply_parameters = null)
    {
        return returnedMessage::create($this->bot('sendPaidMedia', compact(
            'chat_id', 'star_count', 'media', 'payload', 'caption', 'parse_mode',
            'caption_entities', 'show_caption_above_media', 'disable_notification',
            'protect_content', 'allow_paid_broadcast', 'business_connection_id',
            'reply_markup', 'reply_parameters'
        )));
    }

    /**
     * @return returnedMessage
     */
    public function sendMediaGroup($chat_id, array $media, bool $disable_notification = false, bool $protect_content = false, bool $allow_paid_broadcast = false, ?string $business_connection_id = null, ?string $message_effect_id = null, $reply_parameters = null)
    {
        return returnedMessage::create($this->bot('sendMediaGroup', compact(
            'chat_id', 'media', 'disable_notification', 'protect_content',
            'allow_paid_broadcast', 'business_connection_id',
            'message_effect_id', 'reply_parameters'
        )));
    }

    /**
     * @return returnedMessage
     */
    public function sendLocation($chat_id, float $latitude, float $longitude, ?float $horizontal_accuracy = null, ?int $live_period = null, ?int $heading = null, ?int $proximity_alert_radius = null, bool $disable_notification = false, bool $protect_content = false, bool $allow_paid_broadcast = false, ?string $business_connection_id = null, ?string $message_effect_id = null, $reply_parameters = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendLocation', compact(
            'chat_id', 'latitude', 'longitude', 'horizontal_accuracy', 'live_period', 'heading', 'proximity_alert_radius', 'disable_notification', 'protect_content', 'allow_paid_broadcast', 'business_connection_id', 'message_effect_id', 'reply_parameters', 'reply_markup'
        )));
    }

    public function sendVenue($chat_id, float $latitude, float $longitude, string $title, string $address, ?string $foursquare_id = null, ?string $foursquare_type = null, ?string $google_place_id = null, ?string $google_place_type = null, bool $disable_notification = false, bool $protect_content = false, bool $allow_paid_broadcast = false, ?string $business_connection_id = null, ?string $message_effect_id = null, $reply_parameters = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendVenue', compact('chat_id', 'latitude', 'longitude', 'title', 'address', 'foursquare_id', 'foursquare_type', 'google_place_id', 'google_place_type', 'disable_notification', 'protect_content', 'allow_paid_broadcast', 'business_connection_id', 'message_effect_id', 'reply_parameters', 'reply_markup')));
    }

    /**
     * @return returnedMessage
     */
    public function sendContact($chat_id, string $phone_number, string $first_name, ?string $last_name = null, ?string $vcard = null, bool $disable_notification = false, bool $protect_content = false, ?int $reply_to_message_id = null, ?array $reply_markup = null, $allow_sending_without_reply = true)
    {
        return $this->bot('sendContact', compact('chat_id', 'phone_number', 'first_name', 'last_name', 'vcard', 'disable_notification', 'protect_content', 'reply_to_message_id', 'reply_markup', 'allow_sending_without_reply'));
    }


    public function sendPoll($chat_id, $question, $options, ?string $question_parse_mode = null, $question_entities = null, $is_anonymous = true, $type = "regular", $allows_multiple_answers = false, $correct_option_id = null, $explanation = null, ?string $explanation_parse_mode = null, $explanation_entities = null, $open_period = null, $close_date = null, $is_closed = null, $disable_notification = null, $protect_content = null, $allow_paid_broadcast = null, ?string $message_effect_id = null, $reply_parameters = null, $reply_markup = null): returnedMessage
    {
        return returnedMessage::create($this->bot('sendPoll', compact('chat_id', 'question', 'question_parse_mode', 'question_entities', 'options', 'is_anonymous', 'type', 'allows_multiple_answers', 'correct_option_id', 'explanation', 'explanation_parse_mode', 'explanation_entities', 'open_period', 'close_date', 'is_closed', 'disable_notification', 'protect_content', 'allow_paid_broadcast', 'message_effect_id', 'reply_parameters', 'reply_markup')));
    }


    public function sendDice($chat_id, $emoji = "🎲", $disable_notification = null, $protect_content = null, $allow_paid_broadcast = null, ?string $message_effect_id = null, $reply_parameters = null, $reply_markup = null): returnedMessage
    {
        return returnedMessage::create($this->bot('sendDice', compact('chat_id', 'emoji', 'disable_notification', 'protect_content', 'allow_paid_broadcast', 'message_effect_id', 'reply_parameters', 'reply_markup')));
    }


    public function sendChatAction($chat_id, $action, $message_thread_id = null, $business_connection_id = null): returned
    {
        return returned::create($this->bot('sendChatAction', compact('chat_id', 'action', 'message_thread_id', 'business_connection_id')));
    }

    public function setMessageReaction($chat_id, $message_id, $reaction = null, $is_big = null): returned
    {
        return returned::create($this->bot('setMessageReaction', compact('chat_id', 'message_id', 'reaction', 'is_big')));
    }


    public function getUserProfilePhotos($user_id, $offset = null, $limit = null): returnedUserProfilePhotos
    {
        return returnedUserProfilePhotos::create($this->bot('getUserProfilePhotos', compact('user_id', 'offset', 'limit')));
    }

    public function setUserEmojiStatus($user_id, $emoji_status_custom_emoji_id = null, $emoji_status_expiration_date = null): returned
    {
        return returned::create($this->bot('setUserEmojiStatus', compact('user_id', 'emoji_status_custom_emoji_id', 'emoji_status_expiration_date')));
    }

    public function getFile(string $file_id): returnedFile
    {
        return returnedFile::create($this->bot('getFile', compact('file_id')));
    }

    public function banChatMember($chat_id, $user_id, $until_date = null, $revoke_messages = true): returned
    {
        return returned::create($this->bot('banChatMember', compact('chat_id', 'user_id', 'until_date', 'revoke_messages')));
    }

    public function unbanChatMember($chat_id, $user_id, $only_if_banned = false): returned
    {
        return returned::create($this->bot('unbanChatMember', compact('chat_id', 'user_id', 'only_if_banned')));
    }


    public function restrictChatMember($chat_id, $user_id, $permissions, $use_independent_chat_permissions = false, $until_date = null): returned
    {
        $permissions = json_encode($permissions);
        return returned::create($this->bot('restrictChatMember', compact('chat_id', 'user_id', 'permissions', 'use_independent_chat_permissions', 'until_date')));
    }

    public function promoteChatMember($chat_id, $user_id, $is_anonymous = null, $can_manage_chat = null, $can_delete_messages = null, $can_manage_video_chats = null, $can_restrict_members = null, $can_promote_members = null, $can_change_info = null, $can_invite_users = null, $can_post_stories = null, $can_edit_stories = null, $can_delete_stories = null, $can_post_messages = null, $can_edit_messages = null, $can_pin_messages = null, $can_manage_topics = null): returned
    {
        return returned::create($this->bot('promoteChatMember', compact('chat_id', 'user_id', 'is_anonymous', 'can_manage_chat', 'can_delete_messages', 'can_manage_video_chats', 'can_restrict_members', 'can_promote_members', 'can_change_info', 'can_invite_users', 'can_post_stories', 'can_edit_stories', 'can_delete_stories', 'can_post_messages', 'can_edit_messages', 'can_pin_messages', 'can_manage_topics')));
    }

    public function setChatAdministratorCustomTitle($chat_id, $user_id, $custom_title): returned
    {
        return returned::create($this->bot('setChatAdministratorCustomTitle', compact('chat_id', 'user_id', 'custom_title')));
    }

    public function banChatSenderChat($chat_id, $sender_chat_id): returned
    {
        return returned::create($this->bot('banChatSenderChat', compact('chat_id', 'sender_chat_id')));
    }

    public function unbanChatSenderChat($chat_id, $sender_chat_id): returned
    {
        return returned::create($this->bot('unbanChatSenderChat', compact('chat_id', 'sender_chat_id')));
    }

    public function setChatPermissions($chat_id, $permissions, $use_independent_chat_permissions = null): returned
    {
        $permissions = json_encode($permissions);

        return returned::create($this->bot('setChatPermissions', compact('chat_id', 'permissions', 'use_independent_chat_permissions')));
    }

    public function exportChatInviteLink($chat_id): returnedString
    {
        return returnedString::create($this->bot('exportChatInviteLink', compact('chat_id')));
    }

    public function createChatInviteLink($chat_id, $name = null, $expire_date = null, $member_limit = null, $creates_join_request = null): returnedChatInviteLink
    {
        return returnedChatInviteLink::create($this->bot('createChatInviteLink', compact('chat_id', 'name', 'expire_date', 'member_limit', 'creates_join_request')));
    }

    public function editChatInviteLink($chat_id, $invite_link, $name = null, $expire_date = null, $member_limit = null, $creates_join_request = null): returnedChatInviteLink
    {
        return returnedChatInviteLink::create($this->bot('editChatInviteLink', compact('chat_id', 'invite_link', 'name', 'expire_date', 'member_limit', 'creates_join_request')));
    }

    public function createChatSubscriptionInviteLink($chat_id, $name, $subscription_period, $subscription_price): returnedChatInviteLink
    {
        return returnedChatInviteLink::create($this->bot('createChatSubscriptionInviteLink', compact('chat_id', 'name', 'subscription_period', 'subscription_price')));
    }

    public function editChatSubscriptionInviteLink($chat_id, $invite_link, $name = null): returnedChatInviteLink
    {
        return returnedChatInviteLink::create($this->bot('editChatSubscriptionInviteLink', compact('chat_id', 'invite_link', 'name')));
    }

    public function revokeChatInviteLink($chat_id, $invite_link): returnedChatInviteLink
    {
        return returnedChatInviteLink::create($this->bot('revokeChatInviteLink', compact('chat_id', 'invite_link')));
    }

    public function approveChatJoinRequest($chat_id, $user_id): returned
    {
        return returned::create($this->bot('approveChatJoinRequest', compact('chat_id', 'user_id')));
    }


    public function declineChatJoinRequest($chat_id, $user_id): returned
    {
        return returned::create($this->bot('declineChatJoinRequest', compact('chat_id', 'user_id')));
    }

    public function setChatPhoto($chat_id, $photo): returned
    {
        return returned::create($this->bot('setChatPhoto', compact('chat_id', 'photo')));
    }

    public function deleteChatPhoto($chat_id): returned
    {
        return returned::create($this->bot('deleteChatPhoto', compact('chat_id')));
    }

    public function setChatTitle($chat_id, $title): returned
    {
        return returned::create($this->bot('setChatTitle', compact('chat_id', 'title')));
    }

    public function setChatDescription($chat_id, string $description): returned
    {
        return returned::create($this->bot('setChatDescription', compact('chat_id', 'description')));
    }

    public function pinChatMessage($chat_id, int $message_id, $business_connection_id = null, bool $disable_notification = false): returned
    {
        return returned::create($this->bot('pinChatMessage', compact('chat_id', 'message_id', 'business_connection_id', 'disable_notification')));
    }

    public function unpinChatMessage($chat_id, $message_id = null, $business_connection_id = null): returned
    {
        return returned::create($this->bot('unpinChatMessage', compact('chat_id', 'message_id', 'business_connection_id')));
    }

    public function unpinAllChatMessages($chat_id): returned
    {
        return returned::create($this->bot('unpinAllChatMessages', compact('chat_id')));
    }


    public function LeaveChat($chat_id): returned
    {
        return returned::create($this->bot('LeaveChat', compact('chat_id')));
    }


    public function getChat($chat_id): returnedChat
    {
        return returnedChat::create($this->bot('getChat', compact('chat_id')));
    }

    public function getChatAdministrators($chat_id): returnedChatMember
    {
        return returnedChatMember::create($this->bot('getChatAdministrators', compact('chat_id')));
    }


    public function getChatMembersCount($chat_id): returnedInt
    {
        return returnedInt::create($this->bot('getChatMembersCount', compact('chat_id')));
    }


    public function getChatMember($chat_id, int $user_id): returnedChatMember
    {
        return returnedChatMember::create($this->bot('getChatMember', compact('chat_id', 'user_id')));
    }


    public function setChatStickerSet($chat_id, string $sticker_set_name): returned
    {
        return returned::create($this->bot('setChatStickerSet', compact('chat_id', 'sticker_set_name')));
    }


    public function deleteChatStickerSet($chat_id): returned
    {
        return returned::create($this->bot('deleteChatStickerSet', compact('chat_id')));
    }

    public function getForumTopicIconStickers($chat_id): returnedArrayOfSticker
    {
        return returnedArrayOfSticker::create($this->bot('getForumTopicIconStickers'));
    }

    public function createForumTopic($chat_id, $name, $icon_color = null, $icon_custom_emoji_id = null): returnedForumTopic
    {
        return returnedForumTopic::create($this->bot('createForumTopic', compact('chat_id', 'name', 'icon_color', 'icon_custom_emoji_id')));
    }

    public function editForumTopic($chat_id, $message_thread_id, $name = null, $icon_custom_emoji_id = null): returned
    {
        return returned::create($this->bot('editForumTopic', compact('chat_id', 'message_thread_id', 'name', 'icon_custom_emoji_id')));
    }

    public function closeForumTopic($chat_id, $message_thread_id): returned
    {
        return returned::create($this->bot('closeForumTopic', compact('chat_id', 'message_thread_id')));
    }

    public function reopenForumTopic($chat_id, $message_thread_id): returned
    {
        return returned::create($this->bot('reopenForumTopic', compact('chat_id', 'message_thread_id')));
    }

    public function deleteForumTopic($chat_id, $message_thread_id): returned
    {
        return returned::create($this->bot('deleteForumTopic', compact('chat_id', 'message_thread_id')));
    }

    public function unpinAllForumTopicMessages($chat_id, $message_thread_id): returned
    {
        return returned::create($this->bot('unpinAllForumTopicMessages', compact('chat_id', 'message_thread_id')));
    }

    public function editGeneralForumTopic($chat_id, $name): returned
    {
        return returned::create($this->bot('editGeneralForumTopic', compact('chat_id', 'name')));
    }

    public function closeGeneralForumTopic($chat_id): returned
    {
        return returned::create($this->bot('closeGeneralForumTopic', compact('chat_id')));
    }

    public function reopenGeneralForumTopic($chat_id): returned
    {
        return returned::create($this->bot('reopenGeneralForumTopic', compact('chat_id')));
    }

    public function hideGeneralForumTopic($chat_id): returned
    {
        return returned::create($this->bot('hideGeneralForumTopic', compact('chat_id')));
    }

    public function unhideGeneralForumTopic($chat_id): returned
    {
        return returned::create($this->bot('unhideGeneralForumTopic', compact('chat_id')));
    }

    public function unpinAllGeneralForumTopicMessages($chat_id): returned
    {
        return returned::create($this->bot('unpinAllGeneralForumTopicMessages', compact('chat_id')));
    }

    public function answerCallbackQuery($callback_query_id, string $text, bool $show_alert = false, ?string $url = null, ?int $cache_time = 1): returned
    {
        return returned::create($this->bot('answerCallbackQuery', compact('callback_query_id', 'text', 'show_alert', 'url', 'cache_time')));
    }

    public function getUserChatBoosts($chat_id, $user_id): returnedUserChatBoosts
    {
        return returnedUserChatBoosts::create($this->bot('getUserChatBoosts', compact('chat_id', 'user_id')));
    }

    public function getBusinessConnection($business_connection_id): returnedBusinessConnection
    {
        return returnedBusinessConnection::create($this->bot('getBusinessConnection', compact('business_connection_id')));
    }

    public function setMyCommands($commands, $scope = null, $language_code = null): returned
    {
        return returned::create($this->bot('setMyCommands', compact('commands', 'scope', 'language_code')));
    }

    public function deleteMyCommands($scope = null, $language_code = null): returned
    {
        return returned::create($this->bot('deleteMyCommands', compact('scope', 'language_code')));
    }

    public function getMyCommands($scope = null, $language_code = null): returnedArrayBotCommand
    {
        return returnedArrayBotCommand::create($this->bot('getMyCommands', compact('scope', 'language_code')));
    }

    public function setMyName($name = null, $language_code = null): returned
    {
        return returned::create($this->bot('setMyName', compact('name', 'language_code')));
    }

    public function getMyName($language_code = null): returnedBotName
    {
        return returnedBotName::create($this->bot('getMyName', compact('language_code')));
    }

    public function setMyDescription($description, $language_code = null): returned
    {
        return returned::create($this->bot('setMyDescription', compact('description', 'language_code')));
    }

    public function getMyDescription($language_code = null): returnedBotDescription
    {
        return returnedBotDescription::create($this->bot('getMyDescription', compact('language_code')));
    }

    public function setMyShortDescription($short_description, $language_code = null): returnedBotShortDescription
    {
        return returnedBotShortDescription::create($this->bot('setMyShortDescription', compact('short_description', 'language_code')));
    }

    public function setChatMenuButton($chat_id = null, $menu_button = null): returned
    {
        return returned::create($this->bot('setChatMenuButton', compact('chat_id', 'menu_button')));
    }

    public function getChatMenuButton($chat_id = null): returnedMenuButton
    {
        return returnedMenuButton::create($this->bot('getChatMenuButton', compact('chat_id')));
    }


    public function setMyDefaultAdministratorRights($rights = null, $for_channels = null): returned
    {
        return returned::create($this->bot('setMyDefaultAdministratorRights', compact('rights', 'for_channels')));
    }


    public function getMyDefaultAdministratorRights($for_channels = null): returnedChatAdministratorRights
    {
        return returnedChatAdministratorRights::create($this->bot('getMyDefaultAdministratorRights', compact('for_channels')));
    }

    public function editMessageText($chat_id, $message_id, $text, $parse_mode = null, $reply_markup = null, $inline_message_id = null, $entities = null, $link_preview_options = null): returnedMessage
    {
        return returnedMessage::create($this->bot('editMessageText', compact('chat_id', 'message_id', 'inline_message_id', 'text', 'parse_mode', 'entities', 'link_preview_options', 'reply_markup')));
    }

    public function editMessageCaption($chat_id = null, $message_id = null, $inline_message_id = null, $caption = null, $parse_mode = null, $caption_entities = null, $show_caption_above_media = null, $reply_markup = null): returnedMessage
    {
        return returnedMessage::create($this->bot('editMessageCaption', compact('chat_id', 'message_id', 'inline_message_id', 'caption', 'parse_mode', 'caption_entities', 'show_caption_above_media', 'reply_markup')));
    }


    public function editMessageMedia($chat_id = null, $message_id = null, $inline_message_id = null, $media = null, $reply_markup = null): returnedMessage
    {
        return returnedMessage::create($this->bot('editMessageMedia', compact('chat_id', 'message_id', 'inline_message_id', 'media', 'reply_markup')));
    }

    public function editMessageLiveLocation($chat_id = null, $message_id = null, $inline_message_id = null, $latitude = null, $longitude = null, $live_period = null, $horizontal_accuracy = null, $heading = null, $proximity_alert_radius = null, $reply_markup = null): returnedMessage
    {
        return returnedMessage::create($this->bot('editMessageLiveLocation', compact('chat_id', 'message_id', 'inline_message_id', 'latitude', 'longitude', 'live_period', 'horizontal_accuracy', 'heading', 'proximity_alert_radius', 'reply_markup')));
    }

    public function stopMessageLiveLocation($chat_id = null, $message_id = null, $inline_message_id = null, $reply_markup = null): returnedMessage
    {
        return returnedMessage::create($this->bot('stopMessageLiveLocation', compact('chat_id', 'message_id', 'inline_message_id', 'reply_markup')));
    }

    public function editMessageReplyMarkup($chat_id = null, $message_id = null, $inline_message_id = null, $reply_markup = null): returnedMessage
    {
        return returnedMessage::create($this->bot('editMessageReplyMarkup', compact('chat_id', 'message_id', 'inline_message_id', 'reply_markup')));
    }

    public function stopPoll($chat_id, $message_id, $reply_markup = null): returnedPoll
    {
        return returnedPoll::create($this->bot('stopPoll', compact('chat_id', 'message_id', 'reply_markup')));
    }

    public function deleteMessage($chat_id, $message_id): returned
    {
        return returned::create($this->bot('deleteMessage', compact('chat_id', 'message_id')));
    }

    public function deleteMessages($chat_id, $message_ids): returned
    {
        return returned::create($this->bot('deleteMessages', compact('chat_id', 'message_ids')));
    }

    public function sendSticker($chat_id, $sticker, $message_thread_id = null, $emoji = null, bool $disable_notification = false, bool $protect_content = false, bool $allow_paid_broadcast = false, ?string $message_effect_id = null, $reply_parameters = null, $reply_markup = null): returnedMessage
    {
        return returnedMessage::create($this->bot('sendSticker', compact('chat_id', 'sticker', 'message_thread_id', 'emoji', 'disable_notification', 'protect_content', 'allow_paid_broadcast', 'message_effect_id', 'reply_parameters', 'reply_markup')));
    }

    public function getStickerSet(string $name): returnedStickerSet
    {
        return returnedStickerSet::create($this->bot('getStickerSet', compact('name')));
    }


    public function getCustomEmojiStickers($custom_emoji_ids): returnedArrayOfSticker
    {
        return returnedArrayOfSticker::create($this->bot('getCustomEmojiStickers', compact('custom_emoji_ids')));
    }

    public function uploadStickerFile($user_id, $sticker, $sticker_format): returnedFile
    {
        return returnedFile::create($this->bot('uploadStickerFile', compact('user_id', 'sticker', 'sticker_format')));
    }

    public function createNewStickerSet($user_id, $name, $title, $stickers, $sticker_type = 'regular', $needs_repainting = false): returned
    {
        return returned::create($this->bot('createNewStickerSet', compact('user_id', 'name', 'title', 'stickers', 'sticker_type', 'needs_repainting')));
    }

    public function addStickerToSet($user_id, $name, $sticker): returned
    {
        return returned::create($this->bot('addStickerToSet', compact('user_id', 'name', 'sticker')));
    }


    public function setStickerPositionInSet(string $sticker, int $position): returned
    {
        return returned::create($this->bot('setStickerPositionInSet', compact('sticker', 'position')));
    }


    public function deleteStickerFromSet(string $sticker): returned
    {
        return returned::create($this->bot('deleteStickerFromSet', compact('sticker')));
    }

    public function replaceStickerInSet($user_id, $name, $old_sticker, $sticker): returned
    {
        return returned::create($this->bot('replaceStickerInSet', compact('user_id', 'name', 'old_sticker', 'sticker')));
    }

    public function setStickerEmojiList($sticker, $emoji_list): returned
    {
        return returned::create($this->bot('setStickerEmojiList', compact('sticker', 'emoji_list')));
    }

    public function setStickerKeywords($sticker, $keywords = []): returned
    {
        $keywords = json_encode($keywords);
        return returned::create($this->bot('setStickerKeywords', compact('sticker', 'keywords')));
    }

    public function setStickerMaskPosition($sticker, $mask_position = null): returned
    {
        return returned::create($this->bot('setStickerMaskPosition', compact('sticker', 'mask_position')));
    }

    public function setStickerSetTitle($name, $title): returned
    {
        return returned::create($this->bot('setStickerSetTitle', compact('name', 'title')));
    }

    public function setStickerSetThumbnail($name, $user_id, $thumbnail, $format): returned
    {
        return returned::create($this->bot('setStickerSetThumbnail', compact('name', 'user_id', 'thumbnail', 'format')));
    }

    public function setCustomEmojiStickerSetThumbnail($name, $custom_emoji_id = ''): returned
    {
        return returned::create($this->bot('setCustomEmojiStickerSetThumbnail', compact('name', 'custom_emoji_id')));
    }

    public function deleteStickerSet($name): returned
    {
        return returned::create($this->bot('deleteStickerSet', compact('name')));
    }

    public function getAvailableGifts($name): returnedGifts
    {
        return returnedGifts::create($this->bot('getAvailableGifts'));
    }

    public function sendGift($user_id, $chat_id, $gift_id, $pay_for_upgrade = null, $text = null, $text_parse_mode = null, $text_entities = null): returned
    {
        return returned::create($this->bot('sendGift', compact('user_id', 'chat_id', 'gift_id', 'pay_for_upgrade', 'text', 'text_parse_mode', 'text_entities')));
    }

    public function verifyUser($user_id, $custom_description = null): returned
    {
        return returned::create($this->bot('verifyUser', compact('user_id', 'custom_description')));
    }

    public function verifyChat($chat_id, $custom_description = null): returned
    {
        return returned::create($this->bot('verifyUser', compact('chat_id', 'custom_description')));
    }

    public function removeUserVerification($user_id): returned
    {
        return returned::create($this->bot('removeUserVerification', compact('user_id')));
    }

    public function removeChatVerification($chat_id): returned
    {
        return returned::create($this->bot('removeChatVerification', compact('chat_id')));
    }

    public function answerInlineQuery($inline_query_id, $results, $cache_time = 300, $is_personal = false, $next_offset = '', $button = null): returned
    {
        $results = json_encode($results);
        return returned::create($this->bot('answerInlineQuery', compact('inline_query_id', 'results', 'cache_time', 'is_personal', 'next_offset', 'button')));
    }


    public function answerWebAppQuery($web_app_query_id, $result): SentWebAppMessage
    {
        $result = json_encode($result);

        return SentWebAppMessage::create($this->bot('answerWebAppQuery', compact('web_app_query_id', 'result')));
    }


    public function SentWebAppMessage($inline_message_id): returned
    {

        return returned::create($this->bot('SentWebAppMessage', compact('inline_message_id')));
    }

    public function savePreparedInlineMessage($user_id, $result, $allow_user_chats = false, $allow_bot_chats = false, $allow_group_chats = false, $allow_channel_chats = false): returnedPreparedInlineMessage
    {
        return returnedPreparedInlineMessage::create($this->bot('savePreparedInlineMessage', compact('user_id', 'result', 'allow_user_chats', 'allow_bot_chats', 'allow_group_chats', 'allow_channel_chats')));
    }

    public function sendInvoice($chat_id, $title, $description, $payload, $currency, $prices, $provider_token = '', $max_tip_amount = 0, $suggested_tip_amounts = [], $start_parameter = '', $provider_data = '', $photo_url = '', $photo_size = 0, $photo_width = 0, $photo_height = 0, $need_name = false, $need_phone_number = false, $need_email = false, $need_shipping_address = false, $send_phone_number_to_provider = false, $send_email_to_provider = false, $is_flexible = false, $disable_notification = false, $protect_content = false, $allow_paid_broadcast = false, ?string $message_effect_id = '', $reply_parameters = null, $reply_markup = null): returnedMessage
    {
        return returnedMessage::create($this->bot('sendInvoice', compact(
            'chat_id', 'title', 'description', 'payload', 'currency', 'prices',
            'provider_token', 'max_tip_amount', 'suggested_tip_amounts',
            'start_parameter', 'provider_data', 'photo_url', 'photo_size',
            'photo_width', 'photo_height', 'need_name', 'need_phone_number',
            'need_email', 'need_shipping_address', 'send_phone_number_to_provider',
            'send_email_to_provider', 'is_flexible', 'disable_notification',
            'protect_content', 'allow_paid_broadcast', 'message_effect_id',
            'reply_parameters', 'reply_markup'
        )));
    }

    public function createInvoiceLink($title, $description, $payload, $currency, $prices, $business_connection_id = '', $provider_token = '', $subscription_period = 0, $max_tip_amount = 0, $suggested_tip_amounts = [], $provider_data = '', $photo_url = '', $photo_size = 0, $photo_width = 0, $photo_height = 0, $need_name = false, $need_phone_number = false, $need_email = false, $need_shipping_address = false, $send_phone_number_to_provider = false, $send_email_to_provider = false, $is_flexible = false): returnedString
    {
        return returnedString::create($this->bot('createInvoiceLink', compact(
            'title', 'description', 'payload', 'currency', 'prices',
            'business_connection_id', 'provider_token', 'subscription_period',
            'max_tip_amount', 'suggested_tip_amounts', 'provider_data',
            'photo_url', 'photo_size', 'photo_width', 'photo_height', 'need_name',
            'need_phone_number', 'need_email', 'need_shipping_address',
            'send_phone_number_to_provider', 'send_email_to_provider', 'is_flexible'
        )));
    }

    public function answerShippingQuery($shipping_query_id, $ok, $shipping_options = [], $error_message = ''): returned
    {
        return returned::create($this->bot('answerShippingQuery', compact(
            'shipping_query_id', 'ok', 'shipping_options', 'error_message'
        )));
    }

    public function answerPreCheckoutQuery($pre_checkout_query_id, $ok, $error_message = ''): returned
    {
        return returned::create($this->bot('answerPreCheckoutQuery', compact(
            'pre_checkout_query_id', 'ok', 'error_message'
        )));
    }

    public function getStarTransactions($offset = 0, $limit = 100): returnedStarTransaction
    {
        return returnedStarTransaction::create($this->bot('getStarTransactions', compact(
            'offset', 'limit'
        )));
    }

    public function refundStarPayment($user_id, $telegram_payment_charge_id): returned
    {
        return returned::create($this->bot('refundStarPayment', compact(
            'user_id', 'telegram_payment_charge_id'
        )));
    }

    public function editUserStarSubscription($user_id, $telegram_payment_charge_id, $is_canceled): returned
    {
        return returned::create($this->bot('editUserStarSubscription', compact(
            'user_id', 'telegram_payment_charge_id', 'is_canceled'
        )));
    }

    public function sendGame($chat_id, $game_short_name, ?string $business_connection_id = null, ?int $message_thread_id = null, $disable_notification = null, $protect_content = null, $allow_paid_broadcast = null, ?string $message_effect_id = null, $reply_parameters = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendGame', compact(
            'chat_id', 'game_short_name', 'business_connection_id', 'message_thread_id', 'disable_notification', 'protect_content',
            'allow_paid_broadcast', 'message_effect_id', 'reply_parameters', 'reply_markup'
        )));
    }

    public function setGameScore($user_id, $score, bool $force = false, bool $disable_edit_message = false, ?int $chat_id = null, ?int $message_id = null, ?string $inline_message_id = null): returnedMessage|returned
    {
        return returnedMessage::create($this->bot('setGameScore', compact(
            'user_id', 'score', 'force', 'disable_edit_message', 'chat_id', 'message_id', 'inline_message_id'
        )));
    }

    public function getGameHighScores($user_id, ?int $chat_id = null, ?int $message_id = null, ?string $inline_message_id = null): returnedMessage|returned
    {
        return returnedMessage::create($this->bot('getGameHighScores', compact(
            'user_id', 'chat_id', 'message_id', 'inline_message_id'
        )));
    }

    public function getBusinessAccountGifts($business_connection_id, $owned_gift_id): returned
    {
        return returned::create($this->bot('getBusinessAccountGifts', compact(
            'business_connection_id', 'owned_gift_id'
        )));
    }
    public function convertGiftToStars($business_connection_id, $owned_gift_id): returned
    {
        return returned::create($this->bot('convertGiftToStars', compact(
            'business_connection_id', 'owned_gift_id'
        )));
    }

    public function transferGift($business_connection_id, $owned_gift_id, $new_owner_chat_id, $star_count = null): returned
    {
        return returned::create($this->bot('transferGift', compact(
            'business_connection_id', 'new_owner_chat_id', 'owned_gift_id', 'star_count'
        )));
    }

    public function upgradeGift($business_connection_id, $owned_gift_id, $keep_original_details = null, $star_count = null): returned
    {
        return returned::create($this->bot('upgradeGift', compact(
            'business_connection_id', 'keep_original_details', 'owned_gift_id', 'star_count'
        )));
    }

    public function postStory($business_connection_id, $content, $active_period, ?string $caption = null, ?string $parse_mode = null, $caption_entities = null, $areas = null, bool $post_to_chat_page = null, bool $protect_content = null): returnedStory|returned
    {
        return returnedStory::create($this->bot('postStory', compact(
            'business_connection_id', 'active_period', 'content', 'caption', 'parse_mode', 'caption_entities', 'areas'
        )));
    }

    public function editStory($business_connection_id, $story_id, $content, ?string $caption = null, ?string $parse_mode = null, $caption_entities = null, $areas = null): returnedStory|returned
    {
        return returnedStory::create($this->bot('editStory', compact(
            'business_connection_id', 'story_id', 'content', 'caption', 'parse_mode', 'caption_entities', 'areas'
        )));
    }
}