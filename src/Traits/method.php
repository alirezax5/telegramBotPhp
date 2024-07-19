<?php


namespace telegramBotApiPhp\Traits;


use telegramBotApiPhp\Types\{ArrayOfBotCommand,
    ChatAdministratorRights,
    MenuButton,
    returned,
    returnedArrayOfSticker,
    returnedChat,
    returnedChatInviteLink,
    returnedChatMember,
    returnedFile,
    returnedGameHighScore,
    returnedInt,
    returnedMessage,
    returnedStickerSet,
    returnedString,
    returnedUser,
    returnedUserProfilePhotos,
    returnedWebhookInfo};

trait method
{

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
    public function sendMessage($chat_id, string $text, string $parse_mode = 'html', bool $disable_web_page_preview = false, $reply_markup = null, bool $disable_notification = false, bool $protect_content = false, int $reply_to_message_id = null, $entities = null, $allow_sending_without_reply = null)
    {
        return returnedMessage::create($this->bot('sendMessage', compact('chat_id', 'text', 'parse_mode', 'disable_web_page_preview', 'reply_markup', 'disable_notification', 'protect_content', 'reply_to_message_id', 'entities', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedMessage
     */
    public function forwardMessage($chat_id, $from_chat_id, int $message_id, bool $disable_notification = false, bool $protect_content = false)
    {
        return returnedMessage::create($this->bot('forwardMessage', compact('chat_id', 'from_chat_id', 'disable_notification', 'protect_content', 'message_id')));
    }

    /**
     * @return returnedMessage
     */
    public function copyMessage($chat_id, $from_chat_id, int $message_id, $caption = null, $parse_mode = 'html', $reply_markup = null, bool $disable_notification = false, bool $protect_content = false, $reply_to_message_id = null, $allow_sending_without_reply = true)
    {
        return returnedMessage::create($this->bot('copyMessage', compact('chat_id', 'from_chat_id', 'disable_notification', 'protect_content', 'message_id', 'reply_markup', 'caption', 'parse_mode', 'reply_to_message_id', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedMessage
     */
    public function copyMessageNonCaption($chat_id, $from_chat_id, int $message_id, $parse_mode = 'html', $reply_markup = null, bool $disable_notification = false, bool $protect_content = false, $reply_to_message_id = null, $allow_sending_without_reply = true)
    {
        return returnedMessage::create($this->bot('copyMessage', compact('chat_id', 'from_chat_id', 'disable_notification', 'protect_content', 'message_id', 'reply_markup', 'parse_mode', 'reply_to_message_id', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedMessage
     */
    public function sendPhoto($chat_id, $photo, string $caption = null, string $parse_mode = 'html', bool $disable_notification = false, array $reply_markup = null, bool $protect_content = false, int $reply_to_message_id = null, $caption_entities = [], $has_spoiler = false, $allow_sending_without_reply = true)
    {
        return returnedMessage::create($this->bot('sendPhoto', compact('chat_id', 'photo', 'caption', 'parse_mode', 'reply_to_message_id', 'disable_notification', 'protect_content', 'reply_markup', 'caption_entities', 'has_spoiler', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedMessage
     */
    public function sendAudio($chat_id, string $audio, string $caption = null, array $reply_markup = null, string $performer = null, string $title = null, int $duration = null, string $thumb = null, bool $disable_notification = false, bool $protect_content = false, int $reply_to_message_id = null, $caption_entities = [], $allow_sending_without_reply = true)
    {
        return returnedMessage::create($this->bot('sendAudio', compact('chat_id', 'audio', 'caption', 'duration', 'performer', 'title', 'thumb', 'disable_notification', 'protect_content', 'reply_to_message_id', 'reply_markup', 'caption_entities', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedMessage
     */
    public function sendDocument($chat_id, $document, string $caption = null, bool $disable_notification = false, bool $protect_content = false, array $reply_markup = null, string $thumb = null, int $reply_to_message_id = null, string $parse_mode = 'html', $caption_entities = [], $allow_sending_without_reply = true)
    {
        return returnedMessage::create($this->bot('sendDocument', compact('chat_id', 'document', 'thumb', 'parse_mode', 'caption', 'disable_notification', 'protect_content', 'reply_to_message_id', 'reply_markup', 'caption_entities', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedMessage
     */
    public function sendVideo($chat_id, string $video, string $caption = null, array $reply_markup = null, bool $disable_notification = false, bool $protect_content = false, int $reply_to_message_id = null, int $duration = null, int $width = null, int $height = null, string $thumb = null, string $parse_mode = 'html', bool $supports_streaming = true, $caption_entities = [], bool $has_spoiler = false, $allow_sending_without_reply = true)
    {
        return returnedMessage::create($this->bot('sendVideo', compact('chat_id', 'video', 'caption', 'duration', 'disable_notification', 'protect_content', 'width', 'height', 'reply_to_message_id', 'reply_markup', 'thumb', 'parse_mode', 'supports_streaming', 'caption_entities', 'has_spoiler', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedMessage
     */
    public function sendAnimation($chat_id, string $animation, int $duration = null, int $width = null, int $height = null, string $thumb = null, string $caption = null, bool $disable_notification = false, bool $protect_content = false, int $reply_to_message_id = null, array $reply_markup = null, $caption_entities = [], bool $has_spoiler = false, $allow_sending_without_reply = true)
    {
        return returnedMessage::create($this->bot('sendAnimation', compact('chat_id', 'animation', 'caption', 'duration', 'disable_notification', 'protect_content', 'width', 'height', 'reply_to_message_id', 'reply_markup', 'thumb', 'caption_entities', 'has_spoiler', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedMessage
     */
    public function sendVoice($chat_id, string $voice, string $caption = null, string $parse_mode = 'html', bool $disable_notification = false, bool $protect_content = false, array $reply_markup = null, int $reply_to_message_id = null, int $duration = null, $caption_entities = [], $allow_sending_without_reply = true)
    {
        return returnedMessage::create($this->bot('sendVoice', compact('chat_id', 'voice', 'caption', 'parse_mode', 'duration', 'disable_notification', 'protect_content', 'reply_to_message_id', 'reply_markup', 'caption_entities', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedMessage
     */
    public function sendVideoNote($chat_id, string $video_note, array $reply_markup = null, bool $disable_notification = false, bool $protect_content = false, int $reply_to_message_id = null, int $length = null, string $thumb = null, int $duration = null, $allow_sending_without_reply = true)
    {
        return returnedMessage::create($this->bot('sendVideoNote', compact('chat_id', 'video_note', 'duration', 'length', 'thumb', 'disable_notification', 'protect_content', 'reply_to_message_id', 'reply_markup', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedMessage
     */
    public function sendMediaGroup($chat_id, $media, bool $disable_notification = false, bool $protect_content = false, int $reply_to_message_id = null, $allow_sending_without_reply = true)
    {
        return returnedMessage::create($this->bot('sendMediaGroup', compact('chat_id', 'media', 'disable_notification', 'reply_to_message_id', 'allow_sending_without_reply', 'protect_content')));
    }

    /**
     * @return returnedMessage
     */
    public function sendLocation($chat_id, float $latitude, float $longitude, int $live_period = null, array $reply_markup = null, bool $disable_notification = false, bool $protect_content = false, int $reply_to_message_id = null, $allow_sending_without_reply = true, $proximity_alert_radius = null, $heading = null, $horizontal_accuracy = null)
    {
        return returnedMessage::create($this->bot('sendLocation', compact('chat_id', 'latitude', 'longitude', 'live_period', 'disable_notification', 'protect_content', 'reply_to_message_id', 'reply_markup', 'allow_sending_without_reply', 'proximity_alert_radius', 'heading', 'horizontal_accuracy')));
    }

    /**
     * @return returnedMessage
     */
    public function editMessageLiveLocation($chat_id, int $message_id, string $inline_message_id, float $latitude, float $longitude, $horizontal_accuracy = null, $heading = null, $proximity_alert_radius = null, array $reply_markup = null)
    {
        return returnedMessage::create($this->bot('editMessageLiveLocation', compact('chat_id', 'message_id', 'inline_message_id', 'latitude', 'longitude', 'reply_markup', 'horizontal_accuracy', 'heading', 'proximity_alert_radius')));
    }

    /**
     * @return returnedMessage
     */
    public function stopMessageLiveLocation($chat_id, int $message_id, string $inline_message_id, array $reply_markup = null)
    {
        return returnedMessage::create($this->bot('stopMessageLiveLocation', compact('chat_id', 'message_id', 'inline_message_id', 'reply_markup')));
    }

    /**
     * @return returnedMessage
     */
    public function sendVenue($chat_id, $latitude, $longitude, $title, $address, $foursquare_id = null, $foursquare_type = null, $google_place_id = null, $google_place_type = null, array $reply_markup = null, $disable_notification = false, $protect_content = false, $reply_to_message_id = null, $allow_sending_without_reply = true)
    {
        return returnedMessage::create($this->bot('sendVenue', compact('chat_id', 'latitude', 'longitude', 'title', 'address', 'foursquare_id', 'foursquare_type', 'disable_notification', 'protect_content', 'reply_to_message_id', 'reply_markup', 'google_place_id', 'google_place_type', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedMessage
     */
    public function sendContact($chat_id, string $phone_number, string $first_name, string $last_name, string $vcard = null, bool $disable_notification = false, bool $protect_content = false, int $reply_to_message_id = null, array $reply_markup = null, $allow_sending_without_reply = true)
    {
        return $this->bot('sendContact', compact('chat_id', 'phone_number', 'first_name', 'last_name', 'vcard', 'disable_notification', 'protect_content', 'reply_to_message_id', 'reply_markup', 'allow_sending_without_reply'));
    }

    /**
     * @return returnedMessage
     */
    public function sendPoll($chat_id, string $question, array $options, bool $is_anonymous = true, string $type = 'regular', bool $allows_multiple_answers = false, int $correct_option_id = null, $explanation = null, $explanation_parse_mode = null, $explanation_entities = [], $open_period = null, $close_date = null, bool $is_closed = null, bool $disable_notification = false, bool $protect_content = false, int $reply_to_message_id = null, $allow_sending_without_reply = true, array $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendPoll', compact('chat_id', 'question', 'options', 'is_anonymous', 'type', 'allows_multiple_answers', 'correct_option_id', 'is_closed', 'disable_notification', 'reply_to_message_id', 'reply_markup', 'explanation', 'explanation_parse_mode', 'explanation_entities', 'open_period', 'close_date', 'protect_content', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedMessage
     */
    public function sendDice($chat_id, $emoji = '🎲', bool $disable_notification = false, bool $protect_content = false, int $reply_to_message_id = null, array $reply_markup = null, $allow_sending_without_reply = true)
    {
        return returnedMessage::create($this->bot('sendDice', compact('chat_id', 'emoji', 'disable_notification', 'protect_content', 'reply_to_message_id', 'reply_markup', 'allow_sending_without_reply')));
    }

    /**
     * @return returned
     */

    public function sendChatAction($chat_id, string $action = 'typing')
    {
        return returned::create($this->bot('sendChatAction', compact('chat_id', 'action')));
    }

    /**
     * @return returnedUserProfilePhotos
     */
    public function getUserProfilePhotos(int $user_id, int $offset = null, int $limit = null)
    {
        return returnedUserProfilePhotos::create($this->bot('getUserProfilePhotos', compact('user_id', 'offset', 'limit')));
    }


    /**
     * @return returnedFile
     */
    public function getFile(string $file_id)
    {
        return returnedFile::create($this->bot('getFile', compact('file_id')));
    }

    /**
     * @return returned
     */

    public function kickChatMember($chat_id, int $user_id, int $until_date = null, bool $revoke_messages = null)
    {
        return returned::create($this->bot('kickChatMember', compact('chat_id', 'user_id', 'until_date', 'revoke_messages')));
    }


    /**
     * @return returned
     */

    public function unBanChatMember($chat_id, int $user_id)
    {
        return returned::create($this->bot('unbanChatMember', compact('chat_id', 'user_id')));
    }

    /**
     * @return returned
     */
    public function restrictChatMember($chat_id, int $user_id, $permissions, int $until_date = null)
    {
        $permissions = json_encode($permissions);

        return returned::create($this->bot('restrictChatMember', compact('chat_id', 'user_id', 'until_date', 'permissions')));
    }

    /**
     * @return returned
     */
    public function promoteChatMember($chat_id, int $user_id, bool $is_anonymous = true, bool $can_change_info = null, bool $can_post_messages = null, bool $can_edit_messages = null, bool $can_delete_messages = null, bool $can_invite_users = null, bool $can_restrict_members = null, bool $can_pin_messages = null, bool $can_promote_members = null, bool $can_manage_video_chats = null, bool $can_manage_chat = null)
    {
        return returned::create($this->bot('promoteChatMember', compact('chat_id', 'user_id', 'is_anonymous', 'can_change_info', 'can_post_messages', 'can_edit_messages', 'can_delete_messages', 'can_invite_users', 'can_restrict_members', 'can_pin_messages', 'can_promote_members', 'can_manage_video_chats', 'can_manage_chat')));
    }

    /**
     * @return returned
     */
    public function setChatAdministratorCustomTitle($chat_id, int $user_id, string $custom_title)
    {
        return returned::create($this->bot('setChatAdministratorCustomTitle', compact('chat_id', 'user_id', 'custom_title')));
    }

    /**
     * @return returned
     */
    public function setChatPermissions($chat_id, $permissions)
    {
        $permissions = json_encode($permissions);

        return returned::create($this->bot('setChatPermissions', compact('chat_id', 'permissions')));
    }

    /**
     * @return returned
     */
    public function banChatSenderChat($chat_id, $sender_chat_id)
    {

        return returned::create($this->bot('banChatSenderChat', compact('chat_id', 'sender_chat_id')));
    }

    /**
     * @return returned
     */
    public function unbanChatSenderChat($chat_id, $sender_chat_id)
    {

        return returned::create($this->bot('unbanChatSenderChat', compact('chat_id', 'sender_chat_id')));
    }

    /**
     * @return returnedString
     */
    public function exportChatInviteLink($chat_id)
    {
        return returnedString::create($this->bot('exportChatInviteLink', compact('chat_id')));
    }

    /**
     * @return returnedChatInviteLink
     */
    public function createChatInviteLink($chat_id, int $expire_date = null, int $member_limit = null)
    {
        return returnedChatInviteLink::create($this->bot('createChatInviteLink', compact('chat_id', 'expire_date', 'member_limit')));
    }

    /**
     * @return returnedChatInviteLink
     */
    public function editChatInviteLink($chat_id, string $invite_link, int $expire_date = null, int $member_limit = null)
    {
        return returnedChatInviteLink::create($this->bot('editChatInviteLink', compact('chat_id', 'invite_link', 'expire_date', 'member_limit')));
    }

    /**
     * @return returnedChatInviteLink
     */
    public function revokeChatInviteLink($chat_id, string $invite_link)
    {
        return returnedChatInviteLink::create($this->bot('revokeChatInviteLink', compact('chat_id', 'invite_link')));
    }

    /**
     * @return returned
     */
    public function setChatPhoto($chat_id, string $photo)
    {
        return returned::create($this->bot('setChatPhoto', compact('chat_id', 'photo')));
    }

    /**
     * @return returned
     */
    public function deleteChatPhoto($chat_id)
    {
        return returned::create($this->bot('deleteChatPhoto', compact('chat_id')));
    }

    /**
     * @return returned
     */
    public function setChatTitle($chat_id, string $title)
    {
        return returned::create($this->bot('setChatTitle', compact('chat_id', 'title')));
    }

    /**
     * @return returned
     */
    public function setChatDescription($chat_id, string $description)
    {
        return returned::create($this->bot('setChatDescription', compact('chat_id', 'description')));
    }

    /**
     * @return returned
     */
    public function pinChatMessage($chat_id, int $message_id, bool $disable_notification = true)
    {
        return returned::create($this->bot('pinChatMessage', compact('chat_id', 'message_id', 'disable_notification')));
    }

    /**
     * @return returned
     */
    public function unpinChatMessage($chat_id, $message_id)
    {
        return returned::create($this->bot('unpinChatMessage', compact('chat_id', 'message_id')));
    }

    /**
     * @return returned
     */
    public function unpinAllChatMessages($chat_id)
    {
        return returned::create($this->bot('unpinAllChatMessages', compact('chat_id')));
    }

    /**
     * @return returned
     */
    public function LeaveChat($chat_id)
    {
        return returned::create($this->bot('LeaveChat', compact('chat_id')));
    }

    /**
     * @return returnedChat
     */
    public function getChat($chat_id)
    {
        return returnedChat::create($this->bot('getChat', compact('chat_id')));
    }

    /**
     * @return returnedChatMember
     */
    public function getChatAdministrators($chat_id)
    {
        return returnedChatMember::create($this->bot('getChatAdministrators', compact('chat_id')));
    }

    /**
     * @return returnedInt
     */
    public function getChatMembersCount($chat_id)
    {
        return returnedInt::create($this->bot('getChatMembersCount', compact('chat_id')));
    }

    /**
     * @return returnedChatMember
     */
    public function getChatMember($chat_id, int $user_id)
    {
        return returnedChatMember::create($this->bot('getChatMember', compact('chat_id', 'user_id')));
    }

    /**
     * @return returned
     */
    public function setChatStickerSet($chat_id, string $sticker_set_name)
    {
        return returned::create($this->bot('setChatStickerSet', compact('chat_id', 'sticker_set_name')));
    }

    /**
     * @return returned
     */
    public function deleteChatStickerSet($chat_id)
    {
        return returned::create($this->bot('deleteChatStickerSet', compact('chat_id')));
    }

    /**
     * @return returned
     */
    public function answerCallbackQuery($callback_query_id, string $text, bool $show_alert = false, string $url = null, int $cache_time = 1)
    {
        return returned::create($this->bot('answerCallbackQuery', compact('callback_query_id', 'text', 'show_alert', 'url', 'cache_time')));
    }

    /**
     * @return returned
     */
    public function setMyCommands(array $commands)
    {
        return returned::create($this->bot('setMyCommands', compact('commands')));
    }

    /**
     * @return array
     */
    public function getMyCommands()
    {
        return ArrayOfBotCommand::create($this->bot('getMyCommands'));
    }

    /**
     * @return returned
     */
    public function setChatMenuButton($chat_id = null, $menu_button = null)
    {
        return returned::create($this->bot('setChatMenuButton', compact('chat_id', 'menu_button')));
    }

    /**
     * @return MenuButton
     */
    public function getChatMenuButton($chat_id = null)
    {
        return MenuButton::create($this->bot('getChatMenuButton', compact('chat_id')));
    }

    /**
     * @return returned
     */
    public function setMyDefaultAdministratorRights($rights = null, $for_channels = null)
    {
        return returned::create($this->bot('setMyDefaultAdministratorRights', compact('rights', 'for_channels')));
    }

    /**
     * @return ChatAdministratorRights
     */
    public function getMyDefaultAdministratorRights($for_channels = null)
    {
        return ChatAdministratorRights::create($this->bot('getMyDefaultAdministratorRights', compact('for_channels')));
    }

    /**
     * @return returnedMessage
     */
    public function editMessageText($chat_id, $message_id, string $text, $parse_mode = 'html', $inline_message_id = null, bool $disable_web_page_preview = true, array $reply_markup = null, $entities = null)
    {
        return returnedMessage::create($this->bot('editMessageText', compact('chat_id', 'message_id', 'text', 'parse_mode', 'inline_message_id', 'disable_web_page_preview', 'reply_markup', 'entities')));
    }

    /**
     * @return returnedMessage
     */
    public function editMessageCaption($chat_id, int $message_id, string $caption, array $reply_markup = null, string $parse_mode = 'html', string $inline_message_id = null, $caption_entities = null)
    {
        return returnedMessage::create($this->bot('editMessageCaption', compact('chat_id', 'message_id', 'caption', 'reply_markup', 'parse_mode', 'inline_message_id', 'caption_entities')));
    }

    /**
     * @return returnedMessage
     */
    public function editMessageMedia($chat_id, int $message_id, $media, array $reply_markup = null, string $inline_message_id = null)
    {
        return returnedMessage::create($this->bot('editMessageMedia', compact('chat_id', 'message_id', 'media', 'reply_markup', 'inline_message_id')));
    }

    /**
     * @return returnedMessage
     */
    public function editMessageReplyMarkup($chat_id, int $message_id, string $caption, array $reply_markup = null)
    {
        return returnedMessage::create($this->bot('editMessageReplyMarkup', compact('chat_id', 'message_id', 'caption', 'reply_markup')));
    }

    /**
     * @return returned
     */
    public function stopPoll($chat_id, int $message_id, array $reply_markup = null)
    {
        return returned::create($this->bot('stopPoll', compact('chat_id', 'message_id', 'reply_markup')));
    }

    /**
     * @return returned
     */
    public function deleteMessage($chat_id, int $message_id)
    {
        return returned::create($this->bot('deleteMessage', compact('chat_id', 'message_id')));
    }

    /**
     * @return returnedMessage
     */
    public function sendSticker($chat_id, $sticker, bool $disable_notification = true, int $reply_to_message_id = null, array $reply_markup = null, $allow_sending_without_reply = true)
    {
        return returnedMessage::create($this->bot('sendSticker', compact('chat_id', 'sticker', 'disable_notification', 'reply_to_message_id', 'reply_markup', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedStickerSet
     */
    public function getStickerSet(string $name)
    {
        return returnedStickerSet::create($this->bot('getStickerSet', compact('name')));
    }
    /**
     * @return returnedArrayOfSticker
     */
    public function getCustomEmojiStickers( $custom_emoji_ids)
    {
        return returnedArrayOfSticker::create($this->bot('getCustomEmojiStickers', compact('custom_emoji_ids')));
    }

    /**
     * @return returnedFile
     */
    public function uploadStickerFile(int $user_id, string $png_sticker)
    {
        return returnedFile::create($this->bot('uploadStickerFile', compact('user_id', 'png_sticker')));
    }

    /**
     * @return returned
     */
    public function createNewStickerSet(int $user_id, string $name, string $title, $stickers, $sticker_format = 'static', $sticker_type = 'regular', $needs_repainting = null)
    {
        return returned::create($this->bot('createNewStickerSet', compact('user_id', 'name', 'title', 'stickers', 'sticker_format', 'sticker_type', 'needs_repainting')));
    }

    /**
     * @return returned
     */
    public function addStickerToSet(int $user_id, string $name, $sticker)
    {
        return returned::create($this->bot('addStickerToSet', compact('user_id', 'name', 'sticker')));
    }

    /**
     * @return returned
     */
    public function setStickerPositionInSet(string $sticker, int $position)
    {
        return returned::create($this->bot('setStickerPositionInSet', compact('sticker', 'position')));
    }

    /**
     * @return returned
     */
    public function deleteStickerFromSet(string $sticker)
    {
        return returned::create($this->bot('deleteStickerFromSet', compact('sticker')));
    }

    /**
     * @return returned
     */
    public function setStickerSetThumb(string $name, int $user_id, string $thumb = null)
    {

        return returned::create($this->bot('setStickerSetThumb', compact('name', 'user_id', 'thumb')));
    }

    /**
     * @return returned
     */
    public function answerInlineQuery($inline_query_id, array $results, int $cache_time = null, bool $is_personal = null, string $next_offset = null, string $switch_pm_text = null, string $switch_pm_parameter = null)
    {
        $results = json_encode($results);

        return returned::create($this->bot('answerInlineQuery', compact('inline_query_id', 'results', 'cache_time', 'is_personal', 'next_offset', 'switch_pm_text', 'switch_pm_parameter')));
    }

    /**
     * @return returnedSentWebAppMessage
     */
    public function answerWebAppQuery($web_app_query_id, $result)
    {
        $result = json_encode($result);

        return returned::create($this->bot('answerWebAppQuery', compact('web_app_query_id', 'result')));
    }

    /**
     * @return returned
     */
    public function SentWebAppMessage($inline_message_id)
    {

        return returned::create($this->bot('SentWebAppMessage', compact('inline_message_id')));
    }

    /**
     * @return returnedMessage
     */
    public function sendInvoice(int $chat_id, string $title, string $description, string $payload, string $currency,  $prices, string $provider_token = null, string $provider_data = null, string $start_parameter = null, string $photo_url = null, int $photo_size = null, int $photo_width = null, int $photo_height = null, bool $need_name = false, bool $need_phone_number = false, bool $need_email = false, bool $need_shipping_address = false, bool $send_phone_number_to_provider = false, bool $send_email_to_provider = false, bool $is_flexible = false, bool $disable_notification = true, int $reply_to_message_id = null, array $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendInvoice', compact('chat_id', 'title', 'description', 'payload', 'provider_token', 'start_parameter', 'currency', 'prices', 'provider_data', 'photo_url', 'photo_size', 'photo_width', 'photo_height', 'need_name', 'need_phone_number', 'need_email', 'need_shipping_address', 'send_phone_number_to_provider', 'send_email_to_provider', 'is_flexible', 'disable_notification', 'reply_to_message_id', 'reply_markup')));
    }

    /**
     * @return returned
     */
    public function answerShippingQuery(string $shipping_query_id, bool $ok, array $shipping_options = null, string $error_message = null)
    {
        return returned::create($this->bot('answerShippingQuery', compact('shipping_query_id', 'ok', 'shipping_options', 'error_message')));
    }

    /**
     * @return returned
     */

    public function answerPreCheckoutQuery(string $pre_checkout_query_id, bool $ok, string $error_message = null)
    {
        return returned::create($this->bot('answerPreCheckoutQuery', compact('pre_checkout_query_id', 'ok', 'error_message')));
    }

    /**
     * @return returnedMessage
     */
    public function sendGame($chat_id, string $game_short_name, bool $disable_notification = true, string $reply_to_message_id = null, array $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendGame', compact('chat_id', 'game_short_name', 'disable_notification', 'reply_to_message_id', 'reply_markup')));
    }

    /**
     * @return returned
     */
    public function setGameScore(int $user_id, int $score, bool $force = true, bool $disable_edit_message = true, int $chat_id = null, int $message_id = null, string $inline_message_id = null)
    {
        return returned::create($this->bot('setGameScore', compact('user_id', 'score', 'force', 'disable_edit_message', 'chat_id', 'message_id', 'inline_message_id')));
    }

    /**
     * @return returnedGameHighScore
     */
    public function getGameHighScores(int $user_id, int $chat_id = null, int $message_id = null, $inline_message_id = null)
    {
        return returnedGameHighScore::create($this->bot('getGameHighScores', compact('user_id', 'chat_id', 'message_id', 'inline_message_id')));
    }
}