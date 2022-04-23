<?php


namespace telegramBotApiPhp\Types;

/**
 * Class returned
 * @package telegramBotApiPhp\Types
 * @method bool getOk()
 * @method int getErrorCode()
 * @method string getDescription()
 * @method ArrayOfGameHighScore getResult()
 * @method bool issetOk()
 * @method bool issetErrorCode()
 * @method bool issetDescription()
 * @method bool issetResult()
 */
class returnedGameHighScore extends base
{
    static protected $map = [
        'ok' => true,
        'error_code' => true,
        'description' => true,
        'result' => ArrayOfGameHighScore::class,
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