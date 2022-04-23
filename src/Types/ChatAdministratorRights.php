<?php


namespace telegramBotApiPhp\Types;


/**
 * Class ChatAdministratorRights
 * @package telegramBotApiPhp\Types
 * @method Boolean getIsAnonymous()
 * @method Boolean getCanManageChat()
 * @method Boolean getCanDeleteMessages()
 * @method Boolean getCanManageVideoChats()
 * @method Boolean getCanRestrictMembers()
 * @method Boolean getCanPromoteMembers()
 * @method Boolean getCanChangeInfo()
 * @method Boolean getCanInviteUsers()
 * @method Boolean getCanPostMessages()
 * @method Boolean getCanEditMessages()
 * @method Boolean getCanPinMessages()
 * @method Boolean issetIsAnonymous()
 * @method Boolean issetCanManageChat()
 * @method Boolean issetCanDeleteMessages()
 * @method Boolean issetCanManageVideoChats()
 * @method Boolean issetCanRestrictMembers()
 * @method Boolean issetCanPromoteMembers()
 * @method Boolean issetCanChangeInfo()
 * @method Boolean issetCanInviteUsers()
 * @method Boolean issetCanPostMessages()
 * @method Boolean issetCanEditMessages()
 * @method Boolean issetCanPinMessages()

 */
class ChatAdministratorRights extends base
{
    static protected $map = [
        'is_anonymous' => true,
        'can_manage_chat' => true,
        'can_delete_messages' => true,
        'can_manage_video_chats' => true,
        'can_restrict_members' => true,
        'can_promote_members' => true,
        'can_change_info' => true,
        'can_invite_users' => true,
        'can_post_messages' => true,
        'can_edit_messages' => true,
        'can_pin_messages' => true
    ];
    protected $IsAnonymous;
    protected $CanManageChat;
    protected $CanDeleteMessages;
    protected $CanManageVideoChats;
    protected $CanRestrictMembers;
    protected $CanPromoteMembers;
    protected $CanChangeInfo;
    protected $CanInviteUsers;
    protected $CanPostMessages;
    protected $CanEditMessages;
    protected $CanPinMessages;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}