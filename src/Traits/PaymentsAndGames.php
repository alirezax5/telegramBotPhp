<?php

declare(strict_types=1);

namespace telegramBotApiPhp\Traits;

use telegramBotApiPhp\Types\{
    returnedArrayOfGameHighScore, returnedMessage, returnedStarAmount, returnedStarTransaction, returnedString,
};

trait PaymentsAndGames
{


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
