<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Dice
 * @package telegramBotApiPhp\Types
 * @method string getText()
 * @method int getVoter_count()
 */
class PollOption extends base
{
    static protected $map = [
        'text' => true,
        'voter_count' => true,
    ];
    protected $Text;
    protected $Voter_count;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}