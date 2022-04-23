<?php


namespace telegramBotApiPhp\Types;

/**
 * Class PollAnswer
 * @package telegramBotApiPhp\Types
 * @method string getPollId()
 * @method User getUser()
 * @method  getOptionIds()
 */
class PollAnswer extends base
{
    static protected $map = [
        'poll_id' => true,
        'user' => User::class,
        'option_ids' => true,
    ];

    protected $PollId;
    protected $User;
    protected $OptionIds;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}