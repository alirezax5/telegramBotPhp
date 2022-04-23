<?php


namespace telegramBotApiPhp\Types;

/**
 * Class ChosenInlineResult
 * @package telegramBotApiPhp\Types
 * @method string getResultId()
 * @method User getFrom()
 * @method Location getLocation()
 * @method string getInlineMessageId()
 * @method string getQuery()
 */
class ChosenInlineResult extends base
{
    static protected $map = [
        'result_id' => true,
        'from' => User::class,
        'location' => Location::class,
        'inline_message_id' => true,
        'query' => true,
    ];
    protected $ResultId;
    protected $From;
    protected $Location;
    protected $InlineMessageId;
    protected $Query;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}