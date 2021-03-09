<?php


namespace telegramBotApiPhp\Traits;


trait isUpdates
{

    public function isMessage(): bool
    {
        return $this->checkExistUpdate('message');
    }

    public function isEditedMessage(): bool
    {
        return $this->checkExistUpdate('edited_message');
    }

    public function isChannelPost(): bool
    {
        return $this->checkExistUpdate('channel_post');
    }

    public function isEditedChannelPost(): bool
    {
        return $this->checkExistUpdate('edited_channel_post');
    }

    public function isInlineQuery(): bool
    {
        return $this->checkExistUpdate('inline_query');
    }

    public function isChosenInlineResult(): bool
    {
        return $this->checkExistUpdate('chosen_inline_result');
    }

    public function isCallbackQuery(): bool
    {
        return $this->checkExistUpdate('callback_query');
    }

    public function isShippingQuery(): bool
    {
        return $this->checkExistUpdate('shipping_query');
    }

    public function isPreCheckoutQuery(): bool
    {
        return $this->checkExistUpdate('pre_checkout_query');
    }

    public function isPoll(): bool
    {
        return $this->checkExistUpdate('poll');
    }

    public function isPollAnswer(): bool
    {
        return $this->checkExistUpdate('poll_answer');
    }
}