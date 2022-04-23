<?php


namespace telegramBotApiPhp\Types;

/**
 * Class WebAppData
 * @package telegramBotApiPhp\Types
 * @method string getData()
 * @method string getButtonText()
 * @method bool issetData()
 * @method bool issetButtonText()
 */
class WebAppData extends base
{
    static protected $map = [
        'data' => true,
        'button_text' => true,
    ];

    protected $Data;
    protected $ButtonText;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}