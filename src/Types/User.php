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
 * @method bool getCanJoinGroups()
 * @method bool getCanReadAllGroupMessages()
 * @method bool getSupportsInlineQueries()
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
    protected $CanJoinGroups;
    protected $CanReadAllGroupMessages;
    protected $SupportsInlineQueries;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }

}