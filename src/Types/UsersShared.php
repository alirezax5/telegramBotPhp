<?php


namespace telegramBotApiPhp\Types;

/**
 * Class UsersShared
 * @package telegramBotApiPhp\Types
 * @method int getRequestId()
 * @method array getUserIds()
 * @method bool issetRequestId()
 * @method bool issetUserIds()
 */
class UsersShared extends base
{
    static protected $map = [
        'request_id' => true,
        'user_ids' => true

    ];
    protected $RequestId;
    protected $UserIds;



    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}