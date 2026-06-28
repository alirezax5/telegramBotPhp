<?php


namespace telegramBotApiPhp\Traits;


use telegramBotApiPhp\Types\{returned,
    returnedArrayOfChatMember,
    returnedArrayOfGameHighScore,
    returnedArrayOfMessageId,
    returnedArrayOfSticker,
    returnedArrayBotCommand,
    returnedBotAccessSettings,
    returnedBotDescription,
    returnedBotName,
    returnedBotShortDescription,
    returnedBusinessConnection,
    returnedChat,
    returnedChatAdministratorRights,
    returnedChatInviteLink,
    returnedChatMember,
    returnedFile,
    returnedForumTopic,
    returnedGifts,
    returnedInt,
    returnedMenuButton,
    returnedMessage,
    returnedMessageId,
    returnedOwnedGifts,
    returnedPoll,
    returnedPreparedInlineMessage,
    returnedPreparedKeyboardButton,
    returnedStarAmount,
    returnedStarTransaction,
    returnedStickerSet,
    returnedString,
    returnedUser,
    returnedUserChatBoosts,
    returnedUserProfileAudios,
    returnedUserProfilePhotos,
    returnedWebhookInfo,
    SentWebAppMessage,
    returnedStory,
    returnedSentGuestMessage
};

trait method
{

    /**
     * آماده‌سازی داده‌ها برای ارسال به API
     */
    private function prepareBotData(array $data): array
    {
        $jsonFields = [
            'reply_markup', 'prices', 'options', 'commands', 'errors',
            'accepted_gift_types', 'permissions', 'result', 'checklist',
            'content', 'button',
        ];

        foreach ($jsonFields as $field) {
            if (isset($data[$field]) && is_array($data[$field])) {
                $data[$field] = json_encode(
                    $data[$field],
                    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
                );
            }
        }

        $data = $this->prepareMediaForUpload($data);

        return $data;
    }

    /**
     * تبدیل خودکار مسیر فایل‌های محلی به CURLFile
     */
    private function prepareMediaForUpload(array $data): array
    {
        $fileFields = [
            'photo', 'video', 'audio', 'voice', 'animation', 'document',
            'sticker', 'video_note', 'thumbnail', 'certificate'
        ];

        foreach ($fileFields as $field) {
            if (isset($data[$field]) && !is_array($data[$field])) {
                $data[$field] = $this->prepareFileInput($data[$field]);
            }
        }

        if (isset($data['sticker']) && is_array($data['sticker'])) {
            if (isset($data['sticker']['media'])) {
                $data['sticker']['media'] = $this->prepareFileInput($data['sticker']['media']);
            }
            $data['sticker'] = json_encode($data['sticker'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        if (isset($data['media']) && is_array($data['media'])) {
            if (isset($data['media']['media'])) {
                $data['media']['media'] = $this->prepareFileInput($data['media']['media']);
                $data['media'] = json_encode($data['media'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            } else {
                $data['media'] = $this->prepareMediaGroup($data['media']);
            }
        }

        return $data;
    }

    /**
     * آماده‌سازی تک فایل
     */
    private function prepareFileInput($input)
    {
        // اگر قبلاً CURLFile باشد
        if ($input instanceof \CURLFile) {
            return $input;
        }

        // اگر مسیر فایل محلی معتبر باشد
        if (is_string($input) && file_exists($input) && is_readable($input)) {
            return new \CURLFile($input);
        }

        // اگر URL یا file_id باشد، همان را برگردان
        if (is_string($input)) {
            return $input;
        }

        // در غیر این صورت همان را برگردان (ممکن است resource یا چیز دیگر باشد)
        return $input;
    }

    /**
     * آماده‌سازی آرایه media برای sendMediaGroup
     */
    private function prepareMediaGroup(array $mediaItems): string
    {
        foreach ($mediaItems as &$item) {
            if (is_array($item) && isset($item['media'])) {
                $item['media'] = $this->prepareFileInput($item['media']);
            }
        }

        return json_encode($mediaItems, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * متد پایه فراخوانی API
     */
    private function call(string $method, array $data = [], bool $isUpload = false): ?\stdClass
    {
        $data = $this->prepareBotData($data);
        return $this->bot($method, $data, $isUpload);
    }
    // webhook Method

    // ====================== Updates & Webhook ======================

    public function getUpdates(int $offset = 0, int $limit = 10, ?int $timeout = null, ?array $allowed_updates = null): returned
    {
        return returned::create($this->call('getUpdates', compact('offset', 'limit', 'timeout', 'allowed_updates')));
    }

    public function setWebhook(string $url, array $options = []): returned
    {
        $data = ['url' => $url] + $options;
        return returned::create($this->call('setWebhook', $data));
    }

    public function deleteWebhook(): returned
    {
        return returned::create($this->call('deleteWebhook'));
    }

    public function getWebhookInfo(): returnedWebhookInfo
    {
        return returnedWebhookInfo::create($this->call('getWebhookInfo'));
    }

    public function getMe(): returnedUser
    {
        return returnedUser::create($this->call('getMe'));
    }

    /**
     * @return returned
     */
    public function logOut()
    {
        return returned::create($this->call('logOut'));
    }

    /**
     * @return returned
     */
    public function close()
    {
        return returned::create($this->call('close'));
    }

    // ====================== Sending Messages ======================

    /**
     * @return returnedMessage
     */
    public function sendMessage(int|string $chat_id, string $text, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'text') + $options;
        return returnedMessage::create($this->call('sendMessage', $data));
    }


    /**
     * @return returnedMessage
     */
    public function forwardMessage($chat_id, $from_chat_id, int $message_id, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'from_chat_id', 'message_id') + $options;
        return returnedMessage::create($this->call('forwardMessage', $data));
    }

    /**
     * @return returnedMessageId
     */
    public function copyMessage($chat_id, $from_chat_id, int $message_id, array $options = []): returnedMessageId
    {
        $data = compact('chat_id', 'from_chat_id', 'message_id') + $options;
        return returnedMessageId::create($this->call('copyMessage', $data));
    }

    public function forwardMessages($chat_id, $from_chat_id, array $message_ids, array $options = []): returnedArrayOfMessageId
    {
        $data = compact('chat_id', 'from_chat_id', 'message_ids') + $options;

        return returnedArrayOfMessageId::create($this->call('forwardMessages', $data));
    }

    public function copyMessages($chat_id, $from_chat_id, array $message_ids, array $options = []): returnedArrayOfMessageId
    {
        $data = compact('chat_id', 'from_chat_id', 'message_ids') + $options;

        return returnedArrayOfMessageId::create($this->call('copyMessages', $data));
    }

    /**
     * @return returnedMessageId
     */
    public function copyMessageNonCaption($chat_id, $from_chat_id, int $message_id, array $options = [])
    {
        $data = compact('chat_id', 'from_chat_id', 'message_id') + $options;

        return returnedMessageId::create($this->call('copyMessage', $data));
    }

    /**
     * @return returnedMessage
     */
    public function sendPhoto($chat_id, $photo, array $options = [])
    {
        $data = compact('chat_id', 'photo') + $options;

        return returnedMessage::create($this->call('sendPhoto', $data));
    }

    /**
     * @return returnedMessage
     */
    public function sendLivePhoto($chat_id, $live_photo, $photo, array $options = [])
    {
        $data = compact('chat_id', 'live_photo', 'photo') + $options;

        return returnedMessage::create($this->call('sendLivePhoto', $data));
    }


    /**
     * @return returnedMessage
     */

    public function sendAudio($chat_id, $audio, array $options = [])
    {
        $data = compact('chat_id', 'audio') + $options;

        return returnedMessage::create($this->call('sendAudio', $data));
    }

    /**
     * @return returnedMessage
     */

    public function sendDocument($chat_id, $document, array $options = [])
    {
        $data = compact('chat_id', 'document') + $options;

        return returnedMessage::create($this->call('sendDocument', $data));
    }


    /**
     * @return returnedMessage
     */

    public function sendVideo($chat_id, $video, array $options = [])
    {
        $data = compact('chat_id', 'video') + $options;

        return returnedMessage::create($this->call('sendVideo', $data));
    }

    /**
     * @return returnedMessage
     */

    public function sendAnimation($chat_id, $animation, array $options = [])
    {
        $data = compact('chat_id', 'animation') + $options;

        return returnedMessage::create($this->call('sendAnimation', $data));
    }


    /**
     * @return returnedMessage
     */

    public function sendVoice($chat_id, $voice, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'voice') + $options;

        return returnedMessage::create($this->call('sendVoice', $data));
    }


    /**
     * @return returnedMessage
     */

    public function sendVideoNote($chat_id, $video_note, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'video_note') + $options;

        return returnedMessage::create($this->call('sendVideoNote', $data));
    }


    /**
     * @return returnedMessage
     */

    public function sendPaidMedia($chat_id, $star_count, array $media, array $options = [])
    {
        $data = compact('chat_id', 'star_count', 'media') + $options;

        return returnedMessage::create($this->call('sendPaidMedia', $data));
    }


    /**
     * @return returnedMessage
     */
    public function sendMediaGroup($chat_id, array $media, array $options = [])
    {
        $data = compact('chat_id', 'media') + $options;

        return returnedMessage::create($this->call('sendMediaGroup', $data));
    }


    /**
     * @return returnedMessage
     */

    public function sendLocation($chat_id, float $latitude, float $longitude, array $options = [])
    {
        $data = compact('chat_id', 'latitude', 'longitude') + $options;

        return returnedMessage::create($this->call('sendLocation', $data));
    }

    /**
     * @return returnedMessage
     */

    public function sendVenue($chat_id, float $latitude, float $longitude, string $title, string $address, array $options = [])
    {
        $data = compact('chat_id', 'latitude', 'longitude', 'title', 'address') + $options;

        return returnedMessage::create($this->call('sendVenue', $data));
    }

    /**
     * @return returnedMessage
     */

    public function sendContact($chat_id, string $phone_number, string $first_name, array $options = [])
    {
        $data = compact('chat_id', 'phone_number', 'first_name') + $options;

        return returnedMessage::create($this->call('sendContact', $data));
    }


    /**
     * @return returnedMessage
     */

    public function sendPoll($chat_id, $question, $options, array $moreOptions = [])
    {
        $data = compact('chat_id', 'question', 'options') + $moreOptions;

        return returnedMessage::create($this->call('sendPoll', $data));
    }


    /**
     * @return returnedMessage
     */

    public function sendChecklist($business_connection_id, $chat_id, $checklist, array $options = [])
    {
        $data = compact('business_connection_id', 'chat_id', 'checklist') + $options;

        return returnedMessage::create($this->call('sendChecklist', $data));
    }

    /**
     * @return returnedMessage
     */

    public function sendDice($chat_id, $emoji, array $options = [])
    {
        $data = compact('chat_id', 'emoji') + $options;

        return returnedMessage::create($this->call('sendDice', $data));
    }

    /**
     * @return returned
     */

    public function sendMessageDraft($chat_id, $draft_id, array $options = [])
    {
        $data = compact('chat_id', 'draft_id') + $options;

        return returned::create($this->call('sendMessageDraft', $data));
    }

    /**
     * @return returned
     */

    public function sendChatAction($chat_id, $action, array $options = [])
    {
        $data = compact('chat_id', 'action') + $options;

        return returned::create($this->call('sendChatAction', $data));
    }

    /**
     * @return returned
     */

    public function setMessageReaction($chat_id, $message_id, array $options = [])
    {
        $data = compact('chat_id', 'message_id') + $options;

        return returned::create($this->call('setMessageReaction', $data));
    }

    /**
     * @return returnedUserProfilePhotos
     */

    public function getUserProfilePhotos($user_id, array $options = [])
    {
        $data = compact('user_id') + $options;

        return returnedUserProfilePhotos::create($this->call('getUserProfilePhotos', $data));
    }

    /**
     * @return returnedUserProfileAudios
     */

    public function getUserProfileAudios($user_id, array $options = [])
    {
        $data = compact('user_id') + $options;

        return returnedUserProfileAudios::create($this->call('getUserProfileAudios', $data));
    }

    /**
     * @return returnedUserProfileAudios
     */

    public function setUserEmojiStatus($user_id, array $options = [])
    {
        $data = compact('user_id') + $options;

        return returned::create($this->call('setUserEmojiStatus', $data));
    }

    /**
     * @return returnedFile
     */

    public function getFile($file_id, array $options = [])
    {
        $data = compact('file_id') + $options;

        return returnedFile::create($this->call('getFile', $data));
    }

    /**
     * @return returned
     */

    public function banChatMember($chat_id, $user_id, array $options = [])
    {
        $data = compact('chat_id', 'user_id') + $options;

        return returned::create($this->call('banChatMember', $data));
    }

    /**
     * @return returned
     */

    public function unbanChatMember($chat_id, $user_id, array $options = [])
    {
        $data = compact('chat_id', 'user_id') + $options;

        return returned::create($this->call('unbanChatMember', $data));
    }

    /**
     * @return returned
     */

    public function restrictChatMember($chat_id, $user_id, $permissions, array $options = [])
    {
        $data = compact('chat_id', 'user_id', 'permissions') + $options;
        return returned::create($this->call('restrictChatMember', $data));
    }

    /**
     * @return returned
     */

    public function promoteChatMember($chat_id, $user_id, array $options = [])
    {
        $data = compact('chat_id', 'user_id') + $options;

        return returned::create($this->call('promoteChatMember', $data));
    }

    /**
     * @return returned
     */

    public function setChatAdministratorCustomTitle($chat_id, $user_id, $custom_title, array $options = [])
    {
        $data = compact('chat_id', 'user_id', 'custom_title') + $options;

        return returned::create($this->call('setChatAdministratorCustomTitle', $data));
    }

    /**
     * @return returned
     */

    public function setChatMemberTag($chat_id, $user_id, $tag, array $options = [])
    {
        $data = compact('chat_id', 'user_id', 'tag') + $options;

        return returned::create($this->call('setChatMemberTag', $data));
    }

    /**
     * @return returned
     */

    public function banChatSenderChat($chat_id, $sender_chat_id, array $options = [])
    {
        $data = compact('chat_id', 'sender_chat_id') + $options;

        return returned::create($this->call('banChatSenderChat', $data));
    }

    /**
     * @return returned
     */

    public function unbanChatSenderChat($chat_id, $sender_chat_id, array $options = [])
    {
        $data = compact('chat_id', 'sender_chat_id') + $options;

        return returned::create($this->call('unbanChatSenderChat', $data));
    }

    /**
     * @return returned
     */

    public function setChatPermissions($chat_id, $permissions, array $options = []): returned
    {

        $data = compact('chat_id', 'permissions') + $options;

        return returned::create($this->call('setChatPermissions', $data));
    }

    /**
     * @return returnedString
     */
    public function exportChatInviteLink($chat_id): returnedString
    {
        return returnedString::create($this->call('exportChatInviteLink', compact('chat_id')));
    }

    /**
     * @return returnedChatInviteLink
     */

    public function createChatInviteLink($chat_id, array $options = [])
    {

        $data = compact('chat_id') + $options;

        return returnedChatInviteLink::create($this->call('createChatInviteLink', $data));
    }

    /**
     * @return returnedChatInviteLink
     */

    public function editChatInviteLink($chat_id, $invite_link, array $options = [])
    {

        $data = compact('chat_id', 'invite_link') + $options;

        return returnedChatInviteLink::create($this->call('editChatInviteLink', $data));
    }

    /**
     * @return returnedChatInviteLink
     */

    public function createChatSubscriptionInviteLink($chat_id, $subscription_period, $subscription_price, array $options = [])
    {

        $data = compact('chat_id', 'subscription_period', 'subscription_price') + $options;

        return returnedChatInviteLink::create($this->call('createChatSubscriptionInviteLink', $data));
    }

    /**
     * @return returnedChatInviteLink
     */

    public function editChatSubscriptionInviteLink($chat_id, $invite_link, array $options = [])
    {

        $data = compact('chat_id', 'invite_link') + $options;

        return returnedChatInviteLink::create($this->call('editChatSubscriptionInviteLink', $data));
    }


    /**
     * @return returnedChatInviteLink
     */

    public function revokeChatInviteLink($chat_id, $invite_link, array $options = [])
    {

        $data = compact('chat_id', 'invite_link') + $options;

        return returnedChatInviteLink::create($this->call('revokeChatInviteLink', $data));
    }

    /**
     * @return returned
     */

    public function approveChatJoinRequest($chat_id, $user_id, array $options = [])
    {

        $data = compact('chat_id', 'user_id') + $options;

        return returned::create($this->call('approveChatJoinRequest', $data));
    }

    /**
     * @return returned
     */

    public function declineChatJoinRequest($chat_id, $user_id, array $options = [])
    {

        $data = compact('chat_id', 'user_id') + $options;

        return returned::create($this->call('declineChatJoinRequest', $data));
    }

    /**
     * @return returned
     */

    public function setChatPhoto($chat_id, $photo, array $options = [])
    {

        $data = compact('chat_id', 'photo') + $options;

        return returned::create($this->call('setChatPhoto', $data));
    }

    /**
     * @return returned
     */

    public function deleteChatPhoto($chat_id, array $options = [])
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('deleteChatPhoto', $data));
    }

    /**
     * @return returned
     */

    public function setChatTitle($chat_id, $title, array $options = [])
    {

        $data = compact('chat_id', 'title') + $options;

        return returned::create($this->call('setChatTitle', $data));
    }

    /**
     * @return returned
     */

    public function setChatDescription($chat_id, $description, array $options = [])
    {

        $data = compact('chat_id', 'description') + $options;

        return returned::create($this->call('setChatDescription', $data));
    }

    /**
     * @return returned
     */

    public function pinChatMessage($chat_id, int $message_id, array $options = [])
    {

        $data = compact('chat_id', 'message_id') + $options;

        return returned::create($this->call('pinChatMessage', $data));
    }

    /**
     * @return returned
     */

    public function unpinChatMessage($chat_id, array $options = [])
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('unpinChatMessage', $data));
    }

    /**
     * @return returned
     */

    public function unpinAllChatMessages($chat_id, array $options = [])
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('unpinAllChatMessages', $data));
    }

    /**
     * @return returned
     */

    public function leaveChat($chat_id, array $options = [])
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('leaveChat', $data));
    }


    /**
     * @return returnedChat
     */


    public function getChat($chat_id): returnedChat
    {
        return returnedChat::create($this->call('getChat', compact('chat_id')));
    }

    /**
     * @return returnedArrayOfChatMember
     */
    public function getChatAdministrators($chat_id, array $options = []): returnedArrayOfChatMember
    {

        $data = compact('chat_id') + $options;

        return returnedArrayOfChatMember::create($this->call('getChatAdministrators', $data));
    }

    /**
     * @return returnedInt
     */
    public function getChatMemberCount($chat_id, array $options = []): returnedInt
    {

        $data = compact('chat_id') + $options;

        return returnedInt::create($this->call('getChatMemberCount', $data));
    }

    /**
     * @return returnedInt
     */
    public function getChatMembersCount($chat_id, array $options = []): returnedInt
    {

        return $this->getChatMemberCount($chat_id, $options);
    }

    /**
     * @return returnedChatMember
     */
    public function getChatMember($chat_id, $user_id, array $options = [])
    {

        $data = compact('chat_id', 'user_id') + $options;

        return returnedChatMember::create($this->call('getChatMember', $data));
    }

    /**
     * @return returnedMessage
     */
    public function getUserPersonalChatMessages($user_id, $limit, array $options = [])
    {

        $data = compact('limit', 'user_id') + $options;

        return returnedMessage::create($this->call('getUserPersonalChatMessages', $data));
    }

    /**
     * @return returned
     */
    public function setChatStickerSet($chat_id, string $sticker_set_name, array $options = [])
    {

        $data = compact('chat_id', 'sticker_set_name') + $options;

        return returned::create($this->call('setChatStickerSet', $data));
    }

    /**
     * @return returned
     */
    public function deleteChatStickerSet($chat_id, array $options = [])
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('deleteChatStickerSet', $data));
    }

    /**
     * @return returnedArrayOfSticker
     */
    public function getForumTopicIconStickers($chat_id, array $options = [])
    {

        $data = compact('chat_id') + $options;

        return returnedArrayOfSticker::create($this->call('getForumTopicIconStickers', $data));
    }

    /**
     * @return returnedForumTopic
     */
    public function createForumTopic($chat_id, $name, array $options = [])
    {

        $data = compact('chat_id', 'name') + $options;

        return returnedForumTopic::create($this->call('createForumTopic', $data));
    }

    /**
     * @return returned
     */
    public function editForumTopic($chat_id, $message_thread_id, array $options = [])
    {

        $data = compact('chat_id', 'message_thread_id') + $options;

        return returned::create($this->call('editForumTopic', $data));
    }

    /**
     * @return returned
     */
    public function closeForumTopic($chat_id, $message_thread_id, array $options = [])
    {

        $data = compact('chat_id', 'message_thread_id') + $options;

        return returned::create($this->call('closeForumTopic', $data));
    }

    /**
     * @return returned
     */
    public function reopenForumTopic($chat_id, $message_thread_id, array $options = [])
    {

        $data = compact('chat_id', 'message_thread_id') + $options;

        return returned::create($this->call('reopenForumTopic', $data));
    }

    /**
     * @return returned
     */
    public function deleteForumTopic($chat_id, $message_thread_id, array $options = [])
    {

        $data = compact('chat_id', 'message_thread_id') + $options;

        return returned::create($this->call('deleteForumTopic', $data));
    }

    /**
     * @return returned
     */
    public function unpinAllForumTopicMessages($chat_id, $message_thread_id, array $options = []): returned
    {

        $data = compact('chat_id', 'message_thread_id') + $options;

        return returned::create($this->call('unpinAllForumTopicMessages', $data));
    }

    /**
     * @return returned
     */
    public function editGeneralForumTopic($chat_id, $name, array $options = []): returned
    {

        $data = compact('chat_id', 'name') + $options;

        return returned::create($this->call('editGeneralForumTopic', $data));
    }

    /**
     * @return returned
     */
    public function closeGeneralForumTopic($chat_id, array $options = []): returned
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('closeGeneralForumTopic', $data));
    }

    /**
     * @return returned
     */
    public function reopenGeneralForumTopic($chat_id, array $options = []): returned
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('reopenGeneralForumTopic', $data));
    }

    /**
     * @return returned
     */
    public function hideGeneralForumTopic($chat_id, array $options = []): returned
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('hideGeneralForumTopic', $data));
    }

    /**
     * @return returned
     */
    public function unhideGeneralForumTopic($chat_id, array $options = []): returned
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('unhideGeneralForumTopic', $data));
    }

    /**
     * @return returned
     */
    public function unpinAllGeneralForumTopicMessages($chat_id, array $options = []): returned
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('unpinAllGeneralForumTopicMessages', $data));
    }

    /**
     * @return returned
     */
    public function answerCallbackQuery($callback_query_id, ?string $text = null, array $options = []): returned
    {

        $data = compact('callback_query_id') + $options;
        if ($text !== null) {
            $data['text'] = $text;
        }

        return returned::create($this->call('answerCallbackQuery', $data));
    }

    /**
     * @return returnedSentGuestMessage
     */
    public function answerGuestQuery($callback_query_id, $text, array $options = []): returnedSentGuestMessage
    {

        $data = compact('callback_query_id', 'text') + $options;

        return returnedSentGuestMessage::create($this->call('answerGuestQuery', $data));
    }

    /**
     * @return returnedUserChatBoosts
     */
    public function getUserChatBoosts($chat_id, $user_id, array $options = []): returnedUserChatBoosts
    {

        $data = compact('chat_id', 'user_id') + $options;

        return returnedUserChatBoosts::create($this->call('getUserChatBoosts', $data));
    }

    /**
     * @return returnedBusinessConnection
     */
    public function getBusinessConnection($business_connection_id, array $options = []): returnedBusinessConnection
    {

        $data = compact('business_connection_id') + $options;

        return returnedBusinessConnection::create($this->call('getBusinessConnection', $data));
    }

    /**
     * @return returnedString
     */
    public function getManagedBotToken($user_id, array $options = []): returnedString
    {

        $data = compact('user_id') + $options;

        return returnedString::create($this->call('getManagedBotToken', $data));
    }

    /**
     * @return returnedBotAccessSettings
     */
    public function getManagedBotAccessSettings($user_id, array $options = []): returnedBotAccessSettings
    {

        $data = compact('user_id') + $options;

        return returnedBotAccessSettings::create($this->call('getManagedBotAccessSettings', $data));
    }

    /**
     * @return returned
     */
    public function replaceManagedBotToken($user_id, array $options = []): returned
    {

        $data = compact('user_id') + $options;

        return returned::create($this->call('replaceManagedBotToken', $data));
    }

    /**
     * @return returned
     */
    public function setManagedBotAccessSettings($user_id, $is_access_restricted, array $options = []): returned
    {

        $data = compact('user_id', 'is_access_restricted') + $options;

        return returned::create($this->call('setManagedBotAccessSettings', $data));
    }

    /**
     * @return returned
     */
    public function setMyCommands($commands, array $options = []): returned
    {

        $data = compact('commands') + $options;

        return returned::create($this->call('setMyCommands', $data));
    }

    /**
     * @return returned
     */
    public function deleteMyCommands(array $options = []): returned
    {

        $data = $options;

        return returned::create($this->call('deleteMyCommands', $data));
    }

    /**
     * @return returnedArrayBotCommand
     */
    public function getMyCommands(array $options = []): returnedArrayBotCommand
    {

        $data = $options;

        return returnedArrayBotCommand::create($this->call('getMyCommands', $data));
    }


    /**
     * @return returned
     */
    public function setMyName($name = null, $language_code = null, array $options = []): returned
    {

        $data = compact('name', 'language_code') + $options;

        return returned::create($this->call('setMyName', $data));
    }

    /**
     * @return returnedBotName
     */
    public function getMyName($language_code = null, array $options = []): returnedBotName
    {

        $data = compact('language_code') + $options;

        return returnedBotName::create($this->call('getMyName', $data));
    }

    /**
     * @return returned
     */
    public function setMyDescription($description, array $options = []): returned
    {

        $data = compact('description') + $options;

        return returned::create($this->call('setMyDescription', $data));
    }

    /**
     * @return returnedBotDescription
     */
    public function getMyDescription($language_code = null, array $options = []): returnedBotDescription
    {

        $data = compact('language_code') + $options;

        return returnedBotDescription::create($this->call('getMyDescription', $data));
    }

    /**
     * @return returnedBotShortDescription
     */
    public function setMyShortDescription($short_description, $language_code = null, array $options = []): returnedBotShortDescription
    {

        $data = compact('short_description') + $options;

        return returnedBotShortDescription::create($this->call('setMyShortDescription', $data));
    }

    /**
     * @return returned
     */
    public function setMyProfilePhoto($photo, array $options = []): returned
    {

        $data = compact('photo') + $options;

        return returned::create($this->call('setMyProfilePhoto', $data));
    }

    /**
     * @return returned
     */
    public function removeMyProfilePhoto(array $options = []): returned
    {

        $data = $options;

        return returned::create($this->call('removeMyProfilePhoto', $data));
    }


    /**
     * @return returned
     */
    public function setChatMenuButton(array $options = []): returned
    {

        $data = $options;

        return returned::create($this->call('setChatMenuButton', $data));
    }

    /**
     * @return returnedMenuButton
     */
    public function getChatMenuButton(array $options = []): returnedMenuButton
    {

        $data = $options;

        return returnedMenuButton::create($this->call('getChatMenuButton', $data));
    }

    /**
     * @return returned
     */
    public function setMyDefaultAdministratorRights(array $options = []): returned
    {

        $data = $options;

        return returned::create($this->call('setMyDefaultAdministratorRights', $data));
    }


    /**
     * @return returnedChatAdministratorRights
     */
    public function getMyDefaultAdministratorRights(array $options = []): returnedChatAdministratorRights
    {

        $data = $options;

        return returnedChatAdministratorRights::create($this->call('getMyDefaultAdministratorRights', $data));
    }


    /**
     * @return returnedGifts
     */
    public function getAvailableGifts(array $options = []): returnedGifts
    {

        $data = $options;

        return returnedGifts::create($this->call('getAvailableGifts', $data));
    }

    /**
     * @return returned
     */
    public function sendGift($gift_id, array $options = []): returned
    {

        $data = compact('gift_id') + $options;

        return returned::create($this->call('sendGift', $data));
    }


    /**
     * @return returned
     */
    public function giftPremiumSubscription($user_id, $month_count, $star_count, array $options = []): returned
    {

        $data = compact('user_id', 'month_count', 'star_count') + $options;

        return returned::create($this->call('giftPremiumSubscription', $data));
    }

    /**
     * @return returned
     */
    public function verifyUser($user_id, array $options = []): returned
    {

        $data = compact('user_id') + $options;

        return returned::create($this->call('verifyUser', $data));
    }

    /**
     * @return returned
     */
    public function verifyChat($chat_id, array $options = []): returned
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('verifyChat', $data));
    }


    /**
     * @return returned
     */
    public function removeUserVerification($user_id, array $options = []): returned
    {

        $data = compact('user_id') + $options;

        return returned::create($this->call('removeUserVerification', $data));
    }

    /**
     * @return returned
     */
    public function removeChatVerification($chat_id, array $options = []): returned
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('removeChatVerification', $data));
    }

    /**
     * @return returned
     */
    public function readBusinessMessage($business_connection_id, $chat_id, $message_id, array $options = []): returned
    {

        $data = compact('business_connection_id', 'chat_id', 'message_id') + $options;

        return returned::create($this->call('readBusinessMessage', $data));
    }

    /**
     * @return returned
     */
    public function deleteBusinessMessages($business_connection_id, $message_ids, array $options = []): returned
    {

        $data = compact('business_connection_id', 'message_ids') + $options;

        return returned::create($this->call('deleteBusinessMessages', $data));
    }

    /**
     * @return returned
     */
    public function setBusinessAccountName($business_connection_id, $first_name, array $options = []): returned
    {

        $data = compact('business_connection_id', 'first_name') + $options;

        return returned::create($this->call('setBusinessAccountName', $data));
    }

    /**
     * @return returned
     */
    public function setBusinessAccountUsername($business_connection_id, $username, array $options = []): returned
    {

        $data = compact('business_connection_id', 'username') + $options;

        return returned::create($this->call('setBusinessAccountUsername', $data));
    }

    /**
     * @return returned
     */
    public function setBusinessAccountBio($business_connection_id, $bio, array $options = []): returned
    {

        $data = compact('business_connection_id', 'bio') + $options;

        return returned::create($this->call('setBusinessAccountBio', $data));
    }


    /**
     * @return returned
     */
    public function setBusinessAccountProfilePhoto($business_connection_id, $photo, array $options = []): returned
    {

        $data = compact('business_connection_id', 'photo') + $options;

        return returned::create($this->call('setBusinessAccountProfilePhoto', $data));
    }

    /**
     * @return returned
     */
    public function removeBusinessAccountProfilePhoto($business_connection_id, array $options = []): returned
    {

        $data = compact('business_connection_id') + $options;

        return returned::create($this->call('removeBusinessAccountProfilePhoto', $data));
    }

    /**
     * @return returned
     */
    public function setBusinessAccountGiftSettings($business_connection_id, $show_gift_button, $accepted_gift_types, array $options = []): returned
    {

        $data = compact('business_connection_id', 'show_gift_button', 'accepted_gift_types') + $options;

        return returned::create($this->call('setBusinessAccountGiftSettings', $data));
    }

    /**
     * /**
     * @return returnedStarAmount
     */
    public function getBusinessAccountStarBalance($business_connection_id, array $options = []): returnedStarAmount
    {

        $data = compact('business_connection_id') + $options;

        return returnedStarAmount::create($this->call('getBusinessAccountStarBalance', $data));
    }

    /**
     * @return returned
     */
    public function transferBusinessAccountStars($business_connection_id, $star_count, array $options = []): returned
    {

        $data = compact('business_connection_id', 'star_count') + $options;

        return returned::create($this->call('transferBusinessAccountStars', $data));
    }

    /**
     * @return returnedOwnedGifts
     */
    public function getBusinessAccountGifts($business_connection_id, array $options = []): returnedOwnedGifts
    {

        $data = compact('business_connection_id') + $options;

        return returnedOwnedGifts::create($this->call('getBusinessAccountGifts', $data));
    }

    /**
     * @return returnedOwnedGifts
     */
    public function getUserGifts($user_id, array $options = []): returnedOwnedGifts
    {

        $data = compact('user_id') + $options;

        return returnedOwnedGifts::create($this->call('getUserGifts', $data));
    }

    /**
     * @return returnedOwnedGifts
     */
    public function getChatGifts($chat_id, array $options = []): returnedOwnedGifts
    {

        $data = compact('chat_id') + $options;

        return returnedOwnedGifts::create($this->call('getChatGifts', $data));
    }

    /**
     * @return returned
     */
    public function convertGiftToStars($business_connection_id, $owned_gift_id, array $options = []): returned
    {

        $data = compact('business_connection_id', 'owned_gift_id') + $options;

        return returned::create($this->call('convertGiftToStars', $data));
    }

    /**
     * @return returned
     */
    public function upgradeGift($business_connection_id, $owned_gift_id, array $options = []): returned
    {

        $data = compact('business_connection_id', 'owned_gift_id') + $options;

        return returned::create($this->call('upgradeGift', $data));
    }

    /**
     * @return returned
     */
    public function transferGift($business_connection_id, $owned_gift_id, $new_owner_chat_id, array $options = []): returned
    {

        $data = compact('business_connection_id', 'owned_gift_id', 'new_owner_chat_id') + $options;

        return returned::create($this->call('transferGift', $data));
    }

    /**
     * @return returnedStory
     */
    public function postStory($business_connection_id, $content, $active_period, array $options = []): returnedStory
    {

        $data = compact('business_connection_id', 'content', 'active_period') + $options;

        return returnedStory::create($this->call('postStory', $data));
    }

    /**
     * @return returnedStory
     */
    public function repostStory($business_connection_id, $from_chat_id, $from_story_id, $active_period, array $options = []): returnedStory
    {

        $data = compact('business_connection_id', 'from_chat_id', 'from_story_id', 'active_period') + $options;

        return returnedStory::create($this->call('repostStory', $data));
    }

    /**
     * @return returnedStory
     */
    public function editStory($business_connection_id, $story_id, $content, array $options = []): returnedStory
    {

        $data = compact('business_connection_id', 'story_id', 'content') + $options;

        return returnedStory::create($this->call('editStory', $data));
    }

    /**
     * @return returned
     */
    public function deleteStory($business_connection_id, $story_id, array $options = []): returned
    {

        $data = compact('business_connection_id', 'story_id') + $options;

        return returned::create($this->call('deleteStory', $data));
    }

    /**
     * @return SentWebAppMessage
     */
    public function answerWebAppQuery($web_app_query_id, $result, array $options = []): SentWebAppMessage
    {

        $data = compact('web_app_query_id', 'result') + $options;

        return SentWebAppMessage::create($this->call('answerWebAppQuery', $data));
    }

    /**
     * @return returnedPreparedInlineMessage
     */
    public function savePreparedInlineMessage($user_id, $result, array $options = []): returnedPreparedInlineMessage
    {

        $data = compact('user_id', 'result') + $options;

        return returnedPreparedInlineMessage::create($this->call('savePreparedInlineMessage', $data));
    }

    /**
     * @return returnedPreparedKeyboardButton
     */
    public function savePreparedKeyboardButton($user_id, $button, array $options = []): returnedPreparedKeyboardButton
    {
        $data = compact('user_id', 'button') + $options;

        return returnedPreparedKeyboardButton::create($this->call('savePreparedKeyboardButton', $data));
    }

    /**
     * @return returnedMessage
     */
    public function editMessageText($chat_id, $message_id, $text, array $options = []): returnedMessage
    {

        $data = compact('chat_id', 'message_id', 'text') + $options;

        return returnedMessage::create($this->call('editMessageText', $data));
    }

    /**
     * @return returnedMessage
     */
    public function editMessageCaption($chat_id, $message_id, $caption, array $options = []): returnedMessage
    {

        $data = compact('chat_id', 'message_id', 'caption') + $options;

        return returnedMessage::create($this->call('editMessageCaption', $data));
    }

    /**
     * @return returnedMessage
     */
    public function editMessageMedia($chat_id, $message_id, $media, array $options = []): returnedMessage
    {

        $data = compact('chat_id', 'message_id', 'media') + $options;

        return returnedMessage::create($this->call('editMessageMedia', $data));
    }

    /**
     * @return returnedMessage
     */
    public function editMessageLiveLocation($chat_id, $message_id, $latitude, $longitude, array $options = []): returnedMessage
    {

        $data = compact('chat_id', 'message_id', 'latitude', 'longitude') + $options;

        return returnedMessage::create($this->call('editMessageLiveLocation', $data));
    }

    /**
     * @return returnedMessage
     */
    public function stopMessageLiveLocation($chat_id, $message_id, array $options = []): returnedMessage
    {

        $data = compact('chat_id', 'message_id') + $options;

        return returnedMessage::create($this->call('stopMessageLiveLocation', $data));
    }

    /**
     * @return returnedMessage
     */
    public function editMessageChecklist($business_connection_id, $chat_id, $message_id, $checklist, array $options = []): returnedMessage
    {

        $data = compact('business_connection_id', 'chat_id', 'message_id', 'checklist') + $options;

        return returnedMessage::create($this->call('editMessageChecklist', $data));
    }

    /**
     * @return returnedMessage
     */
    public function editMessageReplyMarkup($chat_id = null, $message_id = null, $reply_markup = null, array $options = []): returnedMessage
    {

        $data = compact('chat_id', 'message_id', 'reply_markup') + $options;

        return returnedMessage::create($this->call('editMessageReplyMarkup', $data));
    }

    /**
     * @return returnedPoll
     */
    public function stopPoll($chat_id, $message_id, array $options = []): returnedPoll
    {

        $data = compact('chat_id', 'message_id') + $options;

        return returnedPoll::create($this->call('stopPoll', $data));
    }

    /**
     * @return returned
     */
    public function approveSuggestedPost($chat_id, $message_id, array $options = []): returned
    {

        $data = compact('chat_id', 'message_id') + $options;

        return returned::create($this->call('approveSuggestedPost', $data));
    }

    /**
     * @return returned
     */
    public function declineSuggestedPost($chat_id, $message_id, array $options = []): returned
    {

        $data = compact('chat_id', 'message_id') + $options;

        return returned::create($this->call('declineSuggestedPost', $data));
    }


    public function deleteMessage($chat_id, $message_id): returned
    {
        return returned::create($this->call('deleteMessage', compact('chat_id', 'message_id')));
    }

    public function deleteMessages($chat_id, $message_ids): returned
    {
        return returned::create($this->call('deleteMessages', compact('chat_id', 'message_ids')));
    }

    /**
     * @return returned
     */
    public function deleteMessageReaction($chat_id, $message_id, array $options = []): returned
    {

        $data = compact('chat_id', 'message_id') + $options;

        return returned::create($this->call('deleteMessageReaction', $data));
    }

    /**
     * @return returned
     */
    public function deleteAllMessageReactions($chat_id, array $options = []): returned
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('deleteAllMessageReactions', $data));
    }

    /**
     * @return returnedMessage
     */
    public function sendSticker($chat_id, $sticker, array $options = []): returnedMessage
    {

        $data = compact('chat_id', 'sticker') + $options;

        return returnedMessage::create($this->call('sendSticker', $data));
    }

    /**
     * @return returnedStickerSet
     */
    public function getStickerSet($name, array $options = []): returnedStickerSet
    {

        $data = compact('name') + $options;

        return returnedStickerSet::create($this->call('getStickerSet', $data));
    }

    /**
     * @return returnedArrayOfSticker
     */
    public function getCustomEmojiStickers($custom_emoji_ids, array $options = []): returnedArrayOfSticker
    {

        $data = compact('custom_emoji_ids') + $options;

        return returnedArrayOfSticker::create($this->call('getCustomEmojiStickers', $data));
    }

    /**
     * @return returnedFile
     */
    public function uploadStickerFile($user_id, $sticker, $sticker_format, array $options = []): returnedFile
    {

        $data = compact('user_id', 'sticker', 'sticker_format') + $options;

        return returnedFile::create($this->call('uploadStickerFile', $data));
    }

    /**
     * @return returned
     */
    public function createNewStickerSet($user_id, $name, $title, $stickers, array $options = []): returned
    {

        $data = compact('user_id', 'name', 'title', 'stickers') + $options;

        return returned::create($this->call('createNewStickerSet', $data));
    }

    /**
     * @return returned
     */
    public function addStickerToSet($user_id, $name, $title, $sticker, array $options = []): returned
    {

        $data = compact('user_id', 'name', 'sticker') + $options;

        return returned::create($this->call('addStickerToSet', $data));
    }

    /**
     * @return returned
     */
    public function setStickerPositionInSet(string $sticker, int $position, array $options = []): returned
    {

        $data = compact('sticker', 'position') + $options;

        return returned::create($this->call('setStickerPositionInSet', $data));
    }

    /**
     * @return returned
     */
    public function deleteStickerFromSet(string $sticker, array $options = []): returned
    {

        $data = compact('sticker') + $options;

        return returned::create($this->call('deleteStickerFromSet', $data));
    }

    /**
     * @return returned
     */
    public function replaceStickerInSet($user_id, $name, $old_sticker, $sticker, array $options = []): returned
    {

        $data = compact('user_id', 'name', 'old_sticker', 'sticker') + $options;

        return returned::create($this->call('replaceStickerInSet', $data));
    }

    /**
     * @return returned
     */
    public function setStickerEmojiList($sticker, $emoji_list, array $options = []): returned
    {

        $data = compact('sticker', 'emoji_list') + $options;

        return returned::create($this->call('setStickerEmojiList', $data));
    }

    /**
     * @return returned
     */
    public function setStickerKeywords($sticker, $keywords = [], array $options = []): returned
    {

        $data = compact('sticker', 'keywords') + $options;

        return returned::create($this->call('setStickerKeywords', $data));
    }

    /**
     * @return returned
     */
    public function setStickerMaskPosition($sticker, array $options = []): returned
    {

        $data = compact('sticker') + $options;

        return returned::create($this->call('setStickerMaskPosition', $data));
    }

    /**
     * @return returned
     */
    public function setStickerSetTitle($name, $title, array $options = []): returned
    {

        $data = compact('name', 'title') + $options;

        return returned::create($this->call('setStickerSetTitle', $data));
    }

    /**
     * @return returned
     */
    public function setStickerSetThumbnail($name, $user_id, $format, array $options = []): returned
    {

        $data = compact('name', 'user_id', 'format') + $options;

        return returned::create($this->call('setStickerSetThumbnail', $data));
    }

    /**
     * @return returned
     */
    public function setCustomEmojiStickerSetThumbnail($name, array $options = []): returned
    {

        $data = compact('name') + $options;

        return returned::create($this->call('setCustomEmojiStickerSetThumbnail', $data));
    }

    /**
     * @return returned
     */
    public function deleteStickerSet($name, array $options = []): returned
    {

        $data = compact('name') + $options;

        return returned::create($this->call('deleteStickerSet', $data));
    }

    /**
     * @return returned
     */
    public function answerInlineQuery($inline_query_id, $results, array $options = []): returned
    {
        $data = compact('inline_query_id', 'results') + $options;

        return returned::create($this->call('answerInlineQuery', $data));
    }

    /**
     * @return returnedMessage
     */
    public function sendInvoice($chat_id, $title, $description, $payload, $currency, $prices, array $options = []): returnedMessage
    {

        $data = compact('chat_id', 'title', 'description', 'payload', 'currency', 'prices') + $options;

        return returnedMessage::create($this->call('sendInvoice', $data));
    }

    /**
     * @return returnedString
     */
    public function createInvoiceLink($title, $description, $payload, $currency, $prices, array $options = []): returnedString
    {

        $data = compact('title', 'description', 'payload', 'currency', 'prices') + $options;

        return returnedString::create($this->call('createInvoiceLink', $data));
    }


    /**
     * @return returned
     */
    public function answerShippingQuery($shipping_query_id, $ok, array $options = []): returned
    {

        $data = compact('shipping_query_id', 'ok') + $options;

        return returned::create($this->call('answerShippingQuery', $data));
    }

    /**
     * @return returned
     */
    public function answerPreCheckoutQuery($pre_checkout_query_id, $ok, array $options = []): returned
    {

        $data = compact('pre_checkout_query_id', 'ok') + $options;

        return returned::create($this->call('answerPreCheckoutQuery', $data));
    }

    /**
     * @return returnedStarAmount
     */
    public function getMyStarBalance(array $options = []): returnedStarAmount
    {

        $data = $options;

        return returnedStarAmount::create($this->call('getMyStarBalance', $data));
    }

    /**
     * @return returnedStarTransaction
     */
    public function getStarTransactions(array $options = []): returnedStarTransaction
    {

        $data = $options;

        return returnedStarTransaction::create($this->call('getStarTransactions', $data));
    }


    /**
     * @return returned
     */
    public function refundStarPayment($user_id, $telegram_payment_charge_id, array $options = []): returned
    {

        $data = compact('user_id', 'telegram_payment_charge_id') + $options;

        return returned::create($this->call('refundStarPayment', $data));
    }

    /**
     * @return returned
     */
    public function editUserStarSubscription($user_id, $telegram_payment_charge_id, $is_canceled, array $options = []): returned
    {

        $data = compact('user_id', 'telegram_payment_charge_id', 'is_canceled') + $options;

        return returned::create($this->call('editUserStarSubscription', $data));
    }


    /**
     * @return returned
     */
    public function setPassportDataErrors($user_id, $errors, array $options = []): returned
    {

        $data = compact('user_id', 'errors') + $options;

        return returned::create($this->call('setPassportDataErrors', $data));
    }


    /**
     * @return returnedMessage
     */
    public function sendGame($chat_id, $game_short_name, array $options = []): returnedMessage
    {

        $data = compact('chat_id', 'game_short_name') + $options;

        return returnedMessage::create($this->call('sendGame', $data));
    }

    /**
     * @return returnedMessage
     */
    public function setGameScore($user_id, $score, array $options = []): returnedMessage
    {

        $data = compact('user_id', 'score') + $options;

        return returnedMessage::create($this->call('setGameScore', $data));
    }

    /**
     * @return returnedArrayOfGameHighScore
     */
    public function getGameHighScores($user_id, array $options = []): returnedArrayOfGameHighScore
    {

        $data = compact('user_id') + $options;

        return returnedArrayOfGameHighScore::create($this->call('getGameHighScores', $data));
    }

}