<?php


namespace telegramBotApiPhp\Types;

/**
 * Class ChatPhoto
 * @package telegramBotApiPhp\Types
 * @method getSmallFileId()
 * @method getBigFileId()
 */
class ChatPhoto extends base
{
    static protected $map = [
        'small_file_id' => true,
        'big_file_id' => true,
    ];
    protected $SmallFileId;
    protected $BigFileId;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}