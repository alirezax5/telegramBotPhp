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
 * @method Permissions getPermissions()
 * @method int getSlowModeDelay()
 * @method int getLinkedChatId()
 * @method ChatLocation getLocation()
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
    protected $Permissions;
    protected $SlowModeDelay;
    protected $LinkedChatId;
    protected $Location;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }

}