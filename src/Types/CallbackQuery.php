<?php


namespace telegramBotApiPhp\Types;

/**
 * Class CallbackQuery
 * @package telegramBotApiPhp\Types
 * @method string getId()
 * @method User getFrom()
 * @method Message getMessage()
 * @method string getInlineMessageId()
 * @method string getChatInstance()
 * @method string getData()
 * @method string getGameShortName()
 */
class CallbackQuery extends base
{
    static protected $map = [
        'id' => true,
        'from' => User::class,
        'message' => Message::class,
        'inline_message_id' => true,
        'chat_instance' => true,
        'data' => true,
        'game_short_name' => true,
    ];
    protected $Id;
    protected $From;
    protected $Message;
    protected $InlineMessageId;
    protected $ChatInstance;
    protected $Data;
    protected $GameShortName;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}