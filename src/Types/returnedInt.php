<?php


namespace telegramBotApiPhp\Types;

/**
 * Class returnedString
 * @package telegramBotApiPhp\Types
 * @method bool getOk()
 * @method int getErrorCode()
 * @method string getDescription()
 * @method int getResult()
 * @method bool issetOk()
 * @method bool issetErrorCode()
 * @method bool issetDescription()
 * @method bool issetResult()
 */
class returnedInt extends base
{
    static protected $map = [
        'ok' => true,
        'error_code' => true,
        'description' => true,
        'result' => true,
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