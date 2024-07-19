<?php


namespace telegramBotApiPhp\Types;

/**
 * Class ChatShared
 * @package telegramBotApiPhp\Types
 * @method int getRequestId()
 * @method int getChatId()
 * @method bool issetRequestId()
 * @method bool issetChatId()
 */
class ChatShared extends base
{
    static protected $map = [
        'request_id' => true,
        'chat_id' => true

    ];
    protected $RequestId;
    protected $ChatId;



    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}