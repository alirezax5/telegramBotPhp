<?php


namespace telegramBotApiPhp\Types;

/**
 * Class GameHighScore
 * @package telegramBotApiPhp\Types
 * @method string getPosition()
 * @method User getUser()
 * @method string getScore()
 * @method bool issetPosition()
 * @method bool issetUser()
 * @method bool issetScore()
 */
class GameHighScore extends base
{
    static protected $map = [
        'position' => true,
        'user' => User::class,
        'score' => true,
    ];
    protected $Position;
    protected $User;
    protected $Score;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}