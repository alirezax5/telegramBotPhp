<?php

declare(strict_types=1);

namespace telegramBotApiPhp\Traits;

use telegramBotApiPhp\Types\{
    returnedUser, returnedWebhookInfo,returned
};

trait Updates
{

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
}
