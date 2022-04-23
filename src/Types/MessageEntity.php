<?php


namespace telegramBotApiPhp\Types;

/**
 * Class MessageEntity
 * @package telegramBotApiPhp\Types
 * @method string getType()
 * @method int getOffset()
 * @method int getLength()
 * @method string getUrl()
 * @method User getUser()
 * @method string getLanguage()
 */
class MessageEntity extends base
{
    static protected $map = [
        'type' => true,
        'offset' => true,
        'length' => true,
        'url' => true,
        'user' => User::class,
        'language' => true,
    ];
    protected $Type;
    protected $Offset;
    protected $Length;
    protected $Url;
    protected $User;
    protected $Language;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}