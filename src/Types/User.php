<?php


namespace telegramBotApiPhp\Types;

use telegramBotApiPhp\Types\base;

/**
 * Class User
 * @package telegramBotApiPhp\Types
 * @method int getId()
 * @method bool getIsBot()
 * @method string getFirstName()
 * @method string getLastName()
 * @method string getUsername()
 * @method string getLanguageCode()
 * @method bool getIsPremium()
 * @method bool getAddedToAttachmentMenu()
 * @method bool getCanJoinGroups()
 * @method bool getCanReadAllGroupMessages()
 * @method bool getSupportsInlineQueries()
 * @method bool issetId()
 * @method bool issetIsBot()
 * @method bool issetFirstName()
 * @method bool issetLastName()
 * @method bool issetUsername()
 * @method bool issetLanguageCode()
 * @method bool issetIsPremium()
 * @method bool issetAddedToAttachmentMenu()
 * @method bool issetCanJoinGroups()
 * @method bool issetCanReadAllGroupMessages()
 * @method bool issetSupportsInlineQueries()
 */
class User extends base
{
    static protected $map = [
        'id' => true,
        'is_bot' => true,
        'first_name' => true,
        'last_name' => true,
        'username' => true,
        'language_code' => true,
        'is_premium' => true,
        'added_to_attachment_menu' => true,
        'can_join_groups' => true,
        'can_read_all_group_messages' => true,
        'supports_inline_queries' => true,
    ];

    protected $Id;
    protected $IsBot;
    protected $FirstName;
    protected $LastName;
    protected $Username;
    protected $LanguageCode;
    protected $IsPremium;
    protected $AddedToAttachmentMenu;
    protected $CanJoinGroups;
    protected $CanReadAllGroupMessages;
    protected $SupportsInlineQueries;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }

}