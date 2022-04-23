<?php


namespace telegramBotApiPhp\Types;

/**
 * Class File
 * @package telegramBotApiPhp\Types
 * @method ArrayOfUser getUsers()
 * @method bool issetUsers()
 */
class VideoChatParticipantsInvited extends base
{
    static protected $map = [
        'users' => ArrayOfUser::class,
    ];
    protected $Users;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}