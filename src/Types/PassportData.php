<?php


namespace telegramBotApiPhp\Types;

/**
 * Class PassportData
 * @package telegramBotApiPhp\Types
 * @method ArrayOfEncryptedPassportElement getData()
 * @method EncryptedCredentials getCredentials()
 */
class PassportData extends base
{
    static protected $map = [
        'data' => ArrayOfEncryptedPassportElement::class,
        'credentials' => EncryptedCredentials::class,
    ];
    protected $Data;
    protected $Credentials;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}