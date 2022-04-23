<?php


namespace telegramBotApiPhp\Types;

/**
 * Class EncryptedPassportElement
 * @package telegramBotApiPhp\Types
 * @method string getType()
 * @method string getData()
 * @method string getPhoneNumber()
 * @method string getEmail()
 * @method ArrayOfPassportFile getFiles()
 * @method PassportFile getFrontSide()
 * @method PassportFile getReverseSide()
 * @method PassportFile getSelfie()
 * @method ArrayOfPassportFile getTranslation()
 * @method string getHash()
 */
class EncryptedPassportElement extends base
{
    static protected $map = [
        'type' => true,
        'data' => true,
        'phone_number' => true,
        'email' => true,
        'files' => ArrayOfPassportFile::class,
        'front_side' => PassportFile::class,
        'reverse_side' => PassportFile::class,
        'selfie' => PassportFile::class,
        'translation' => ArrayOfPassportFile::class,
        'hash' => true,
    ];
    protected $Type;
    protected $Data;
    protected $PhoneNumber;
    protected $Email;
    protected $Files;
    protected $FrontSide;
    protected $ReverseSide;
    protected $Selfie;
    protected $Translation;
    protected $Hash;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}