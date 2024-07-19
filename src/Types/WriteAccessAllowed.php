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
class WriteAccessAllowed extends base
{
    static protected $map = [
        'from_request' => true,
        'web_app_name' => true,
        'from_attachment_menu' => true

    ];
    protected $RequestId;
    protected $UserIds;



    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}