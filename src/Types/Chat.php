<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Chat
 * @package telegramBotApiPhp\Types
 * @method int getId()
 * @method string getType()
 * @method string getTitle()
 * @method string getFastName()
 * @method string getLastName()
 * @method string getUsername()
 * @method ChatPhoto getPhoto()
 * @method string getDescription()
 * @method string getInviteLink()
 * @method message getPinnedMessage()
 * @method string getStickerSetName()
 * @method bool getCanSetStickerSet()
 * @method string getBio()
 * @method bool getHasPrivateForwards()
 * @method bool getHasProtectedContent()
 * @method bool getIsAutomaticForward()
 * @method Permissions getPermissions()
 * @method int getSlowModeDelay()
 * @method int getLinkedChatId()
 * @method bool issetId()
 * @method bool issetType()
 * @method bool issetTitle()
 * @method bool issetFastName()
 * @method bool issetLastName()
 * @method bool issetUsername()
 * @method bool issetPhoto()
 * @method bool issetDescription()
 * @method bool issetInviteLink()
 * @method bool issetPinnedMessage()
 * @method bool issetStickerSetName()
 * @method bool issetCanSetStickerSet()
 * @method bool issetBio()
 * @method bool issetHasPrivateForwards()
 * @method bool issetHasProtectedContent()
 * @method bool issetIsAutomaticForward()
 * @method bool issetPermissions()
 * @method bool issetSlowModeDelay()
 * @method bool issetLinkedChatId()
 * @method bool issetLocation()
 */
class Chat extends base
{
    static protected $map = [
        'id' => true,
        'type' => true,
        'title' => true,
        'username' => true,
        'first_name' => true,
        'last_name' => true,
        'photo' => ChatPhoto::class,
        'bio' => true,
        'has_private_forwards' => true,
        'has_protected_content' => true,
        'is_automatic_forward' => true,
        'description' => true,
        'invite_link' => true,
        'pinned_message' => Message::class,
        'permissions' => Permissions::class,
        'slow_mode_delay' => true,
        'sticker_set_name' => true,
        'can_set_sticker_set' => true,
        'linked_chat_id' => true,
        'location' => ChatLocation::class
    ];
    protected $Id;
    protected $Type;
    protected $Title;
    protected $FirstName;
    protected $LastName;
    protected $Username;
    protected $Photo;
    protected $Description;
    protected $InviteLink;
    protected $PinnedMessage;
    protected $StickerSetName;
    protected $CanSetStickerSet;
    protected $Bio;
    protected $HasPrivateForwards;
    protected $HasProtectedContent;
    protected $IsAutomaticForward;
    protected $Permissions;
    protected $SlowModeDelay;
    protected $LinkedChatId;
    protected $Location;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }

}