<?php


namespace telegramBotApiPhp\Types;

/**
 * Class returnedUser
 * @package telegramBotApiPhp\Types
 * @method bool getOk()
 * @method int getErrorCode()
 * @method Chat getDescription()
 * @method User getResult()
 * @method bool issetOk()
 * @method bool issetErrorCode()
 * @method bool issetDescription()
 * @method bool issetResult()
 */
class returnedChat extends BaseType
{
    static protected $map = [
        'ok' => true,
        'error_code' => true,
        'description' => true,
        'result' => Chat::class,
    ];

    protected $Ok;
    protected $ErrorCode;
    protected $Description;
    protected $Result;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}