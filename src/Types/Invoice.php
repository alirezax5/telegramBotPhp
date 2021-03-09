<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Invoice
 * @package telegramBotApiPhp\Types
 * @method string getTitle()
 * @method string getDescription()
 * @method string getStartParameter()
 * @method string getCurrency()
 * @method int getTotalAmount()
 */
class Invoice extends base
{
    static protected $map = [
        'title' => true,
        'description' => true,
        'start_parameter' => true,
        'currency' => true,
        'total_amount' => true
    ];

    protected $Title;
    protected $Description;
    protected $StartParameter;
    protected $Currency;
    protected $TotalAmount;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}