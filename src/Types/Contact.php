<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Contact
 * @package telegramBotApiPhp\Types
 * @method string getPhoneNumber()
 * @method string getFirstName()
 * @method string getLastName()
 * @method string getUserId()
 * @method string getVcard()
 */
class Contact extends base
{
    static protected $map = [
        'phone_number' => true,
        'first_name' => true,
        'last_name' => true,
        'user_id' => true,
        'vcard' => true
    ];
    protected $PhoneNumber;
    protected $FirstName;
    protected $LastName;
    protected $UserId;
    protected $Vcard;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}