<?php


namespace telegramBotApiPhp\Types;

/**
 * Class EncryptedCredentials
 * @package telegramBotApiPhp\Types
 * @method string getData()
 * @method string getHash()
 * @method string getSecret()
 */
class EncryptedCredentials extends base
{
    static protected $map = [
        'data' => true,
        'hash' => true,
        'secret' => true,
    ];
    protected $Data;
    protected $Hash;
    protected $Secret;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}