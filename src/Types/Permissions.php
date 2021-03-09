<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Permissions
 * @package telegramBotApiPhp\Types
 * @method bool getCanSendMessages()
 * @method bool getCanSendMediaMessages()
 * @method bool getCanSendPolls()
 * @method bool getCanSendOtherMessages()
 * @method bool getCanAddWebPagePreviews()
 * @method bool getCanChangeInfo()
 * @method bool getCanInviteUsers()
 * @method bool getCanPinMessages()
 */
class Permissions extends base
{
    static protected $map = [
        'can_send_messages' => true,
        'can_send_media_messages' => true,
        'can_send_polls' => true,
        'can_send_other_messages' => true,
        'can_add_web_page_previews' => true,
        'can_change_info' => true,
        'can_invite_users' => true,
        'can_pin_messages' => true
    ];
    protected $CanSendMessages;
    protected $CanSendMediaMessages;
    protected $CanSendPolls;
    protected $CanSendOtherMessages;
    protected $CanAddWebPagePreviews;
    protected $CanChangeInfo;
    protected $CanInviteUsers;
    protected $CanPinMessages;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }

}