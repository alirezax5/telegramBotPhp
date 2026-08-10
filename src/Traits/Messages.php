<?php

declare(strict_types=1);

namespace telegramBotApiPhp\Traits;

use telegramBotApiPhp\Types\{
    returnedArrayOfMessageId, returnedMessage, returnedMessageId, returnedPoll,returned
};

trait Messages
{


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

        // ====================== Ephemeral Messages ======================

        /**
         * Delete an ephemeral message.
         * @return returned
         */
        public function deleteEphemeralMessage($chat_id, $receiver_user_id, $ephemeral_message_id, array $options = []): returned
        {
            $data = compact('chat_id', 'receiver_user_id', 'ephemeral_message_id') + $options;

            return returned::create($this->call('deleteEphemeralMessage', $data));
        }

        /**
         * Edit the caption of an ephemeral message.
         * @return returned
         */
        public function editEphemeralMessageCaption($chat_id, $receiver_user_id, $ephemeral_message_id, array $options = []): returned
        {
            $data = compact('chat_id', 'receiver_user_id', 'ephemeral_message_id') + $options;

            return returned::create($this->call('editEphemeralMessageCaption', $data));
        }

        /**
         * Edit the media of an ephemeral message.
         * @return returned
         */
        public function editEphemeralMessageMedia($chat_id, $receiver_user_id, $ephemeral_message_id, array $options = []): returned
        {
            $data = compact('chat_id', 'receiver_user_id', 'ephemeral_message_id') + $options;

            return returned::create($this->call('editEphemeralMessageMedia', $data));
        }

        /**
         * Edit only the reply markup of an ephemeral message.
         * @return returned
         */
        public function editEphemeralMessageReplyMarkup($chat_id, $receiver_user_id, $ephemeral_message_id, array $options = []): returned
        {
            $data = compact('chat_id', 'receiver_user_id', 'ephemeral_message_id') + $options;

            return returned::create($this->call('editEphemeralMessageReplyMarkup', $data));
        }

        /**
         * Edit an ephemeral text message.
         * @return returned
         */
        public function editEphemeralMessageText($chat_id, $receiver_user_id, $ephemeral_message_id, array $options = []): returned
        {
            $data = compact('chat_id', 'receiver_user_id', 'ephemeral_message_id') + $options;

            return returned::create($this->call('editEphemeralMessageText', $data));
        }

        // ====================== Rich Messages ======================

        /**
         * Send a rich message.
         * @return returnedMessage
         */
        public function sendRichMessage($chat_id, $rich_message, array $options = []): returnedMessage
        {
            $data = compact('chat_id', 'rich_message') + $options;

            return returnedMessage::create($this->call('sendRichMessage', $data));
        }

        /**
         * Stream a partial rich message to a user while the message is being generated.
         * @return returned
         */
        public function sendRichMessageDraft($chat_id, $draft_id, $rich_message, array $options = []): returned
        {
            $data = compact('chat_id', 'draft_id', 'rich_message') + $options;

            return returned::create($this->call('sendRichMessageDraft', $data));
        }
    }
