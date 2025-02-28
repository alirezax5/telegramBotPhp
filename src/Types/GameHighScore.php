<?php
namespace telegramBotApiPhp\Types;

/**
 * Class GameHighScore
 * This object represents one row of the high scores table for a game.
 *
 * @property int $position Position in high score table for the game
 * @property User $user User
 * @property int $score Score
 */
class GameHighScore extends BaseType
{
}
