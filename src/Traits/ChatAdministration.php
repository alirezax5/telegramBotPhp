<?php

declare(strict_types=1);

namespace telegramBotApiPhp\Traits;

use telegramBotApiPhp\Types\{
    SentGuestMessage, returnedArrayOfChatMember, returnedArrayOfSticker, returnedChat, returnedChatInviteLink, returnedForumTopic, returnedInt, returnedMessage, returnedSentGuestMessage, returnedString, returnedUserChatBoosts,
};

trait ChatAdministration
{


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
     * Get information about a member of a chat.
     * @return returnedChatMember
     */
    public function getChatMember($chat_id, $user_id, array $options = []): returnedChatMember
    {
        $data = compact('chat_id', 'user_id') + $options;

        return returnedChatMember::create($this->call('getChatMember', $data));
    }

    /**
     * Process a received chat join request query.
     * @return returned
     */
    public function answerChatJoinRequestQuery($chat_join_request_query_id, $result, array $options = []): returned
    {
        $data = compact('chat_join_request_query_id', 'result') + $options;

        return returned::create($this->call('answerChatJoinRequestQuery', $data));
    }

    /**
     * Process a received chat join request query by showing a Mini App to the user.
     * @return returned
     */
    public function sendChatJoinRequestWebApp($chat_join_request_query_id, $web_app_url, array $options = []): returned
    {
        $data = compact('chat_join_request_query_id', 'web_app_url') + $options;

        return returned::create($this->call('sendChatJoinRequestWebApp', $data));
            }
        }
