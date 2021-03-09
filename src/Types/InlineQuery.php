<?php


namespace telegramBotApiPhp\Types;

/**
 * Class InlineQuery
 * @package telegramBotApiPhp\Types
 * @method string getId()
 * @method User getFrom()
 * @method Location getLocation()
 * @method string getQuery()
 * @method string getOffset()
 */
class InlineQuery extends base
{
    static protected $map = [
        'id' => true,
        'from' => User::class,
        'location' => Location::class,
        'query' => true,
        'offset' => true,
    ];
    protected $Id;
    protected $From;
    protected $Location;
    protected $Query;
    protected $Offset;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}