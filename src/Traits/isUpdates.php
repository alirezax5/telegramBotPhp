<?php


namespace telegramBotApiPhp\Traits;


trait isUpdates
{

    public function isMessage(): bool
    {
        return $this->checkUpdateExists('message');
    }

    public function isEditedMessage(): bool
    {
        return $this->checkUpdateExists('edited_message');
    }

    public function isChannelPost(): bool
    {
        return $this->checkUpdateExists('channel_post');
    }

    public function isEditedChannelPost(): bool
    {
        return $this->checkUpdateExists('edited_channel_post');
    }

    public function isBusinessMessageConnection(): bool
    {
        return $this->checkUpdateExists('business_connection');
    }

    public function isBusinessMessage(): bool
    {
        return $this->checkUpdateExists('business_message');
    }

    public function isEditedBusinessMessage(): bool
    {
        return $this->checkUpdateExists('edited_business_message');
    }

    public function isDeletedBusinessMessages(): bool
    {
        return $this->checkUpdateExists('deleted_business_messages');
    }

    public function isMessageReaction(): bool
    {
        return $this->checkUpdateExists('message_reaction');
    }

    public function isMessageReactionCount(): bool
    {
        return $this->checkUpdateExists('message_reaction_count');
    }

    public function isInlineQuery(): bool
    {
        return $this->checkUpdateExists('inline_query');
    }

    public function isChosenInlineResult(): bool
    {
        return $this->checkUpdateExists('chosen_inline_result');
    }

    public function isCallbackQuery(): bool
    {
        return $this->checkUpdateExists('callback_query');
    }

    public function isShippingQuery(): bool
    {
        return $this->checkUpdateExists('shipping_query');
    }

    public function isPreCheckoutQuery(): bool
    {
        return $this->checkUpdateExists('pre_checkout_query');
    }

    public function ispPurchasedPaidMedia(): bool
    {
        return $this->checkUpdateExists('purchased_paid_media');
    }

    public function isPoll(): bool
    {
        return $this->checkUpdateExists('poll');
    }

    public function isPollAnswer(): bool
    {
        return $this->checkUpdateExists('poll_answer');
    }

    public function isChatJoinRequest(): bool
    {
        return $this->checkUpdateExists('chat_join_request');
    }

    public function isMyChatMember(): bool
    {
        return $this->checkUpdateExists('my_chat_member');
    }

    public function isChatMember(): bool
    {
        return $this->checkUpdateExists('chat_member');
    }

    public function isChatBoost(): bool
    {
        return $this->checkUpdateExists('chat_boost');
    }
}