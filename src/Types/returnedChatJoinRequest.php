<?php


namespace telegramBotApiPhp\Types;

/**
 * Class ChatInviteLink
 * @package telegramBotApiPhp\Types
 * @method bool getOk()
 * @method int getErrorCode()
 * @method string getDescription()
 * @method ChatJoinRequest getResult()
 * @method bool issetOk()
 * @method bool issetErrorCode()
 * @method bool issetDescription()
 * @method bool issetResult()
 */
class returnedChatJoinRequest extends base
{
    static protected $map = [
        'ok' => true,
        'error_code' => true,
        'description' => true,
        'result' => ChatJoinRequest::class,
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