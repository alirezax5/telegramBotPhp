<?php


namespace telegramBotApiPhp\Types;

/**
 * Class ChatMember
 * @package telegramBotApiPhp\Types
 * @method User getUser()
 * @method string getStatus()
 * @method string getCustomTitle()
 * @method bool getIsAnonymous()
 * @method bool getCanBeEdited()
 * @method bool getCanPostMessages()
 * @method bool getCanEditMessages()
 * @method bool getCanDeleteMessages()
 * @method bool getCanRestrictMembers()
 * @method bool getCanPromoteMembers()
 * @method bool getCanChangeInfo()
 * @method bool getCanInviteUsers()
 * @method bool getCanPinMessages()
 * @method bool getIsMember()
 * @method bool getCanSendMessages()
 * @method bool getCanSendMediaMessages()
 * @method bool getCanSendPolls()
 * @method bool getCanSendOtherMessages()
 * @method bool getCanAddWebPagePreviews()
 * @method int getUntilDate()
 * @method int getCanManageVoiceChats()
 * @method int getCanManageChat()
 * @method bool issetUser()
 * @method bool issetStatus()
 * @method bool issetCustomTitle()
 * @method bool issetIsAnonymous()
 * @method bool issetCanBeEdited()
 * @method bool issetCanPostMessages()
 * @method bool issetCanEditMessages()
 * @method bool issetCanDeleteMessages()
 * @method bool issetCanRestrictMembers()
 * @method bool issetCanPromoteMembers()
 * @method bool issetCanChangeInfo()
 * @method bool issetCanInviteUsers()
 * @method bool issetCanPinMessages()
 * @method bool issetIsMember()
 * @method bool issetCanSendMessages()
 * @method bool issetCanSendMediaMessages()
 * @method bool issetCanSendPolls()
 * @method bool issetCanSendOtherMessages()
 * @method bool issetCanAddWebPagePreviews()
 * @method bool issetUntilDate()
 * @method bool issetCanManageVoiceChats()
 * @method bool issetCanManageChat()
 */
class ChatMember extends base
{
    static protected $map = [
        'user' => User::class,
        'status' => true,
        'custom_title' => true,
        'is_anonymous' => true,
        'can_be_edited' => true,
        'can_post_messages' => true,
        'can_edit_messages' => true,
        'can_delete_messages' => true,
        'can_restrict_members' => true,
        'can_promote_members' => true,
        'can_change_info' => true,
        'can_invite_users' => true,
        'can_pin_messages' => true,
        'is_member' => true,
        'can_send_messages' => true,
        'can_send_media_messages' => true,
        'can_send_polls' => true,
        'can_send_other_messages' => true,
        'can_add_web_page_previews' => true,
        'until_date' => true,
        'can_manage_voice_chats' => true,
        'can_manage_chat' => true,
    ];
    protected $User;
    protected $Status;
    protected $CustomTitle;
    protected $IsAnonymous;
    protected $CanBeEdited;
    protected $CanPostMessages;
    protected $CanEditMessages;
    protected $CanDeleteMessages;
    protected $CanRestrictMembers;
    protected $CanPromoteMembers;
    protected $CanChangeInfo;
    protected $CanInviteUsers;
    protected $CanPinMessages;
    protected $IsMember;
    protected $CanSendMessages;
    protected $CanSendMediaMessages;
    protected $CanSendPolls;
    protected $CanSendOtherMessages;
    protected $CanAddWebPagePreviews;
    protected $UntilDate;
    protected $CanManageVoiceChats;
    protected $CanManageChat;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}