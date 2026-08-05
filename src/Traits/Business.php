<?php

declare(strict_types=1);

namespace telegramBotApiPhp\Traits;

use telegramBotApiPhp\Types\{
    SentWebAppMessage, returnedBotAccessSettings, returnedBusinessConnection, returnedGifts, returnedOwnedGifts, returnedPreparedInlineMessage, returnedPreparedKeyboardButton, returnedStarAmount, returnedStory, returnedString,
};

trait Business
{


    /**
     * @return returnedBusinessConnection
     */
    public function getBusinessConnection($business_connection_id, array $options = []): returnedBusinessConnection
    {

        $data = compact('business_connection_id') + $options;

        return returnedBusinessConnection::create($this->call('getBusinessConnection', $data));
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
     * @return returnedGifts
     */
    public function getAvailableGifts(array $options = []): returnedGifts
    {

        $data = $options;

        return returnedGifts::create($this->call('getAvailableGifts', $data));
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
     * @return returned
     */
    public function answerInlineQuery($inline_query_id, $results, array $options = []): returned
    {
        $data = compact('inline_query_id', 'results') + $options;

        return returned::create($this->call('answerInlineQuery', $data));
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
}
