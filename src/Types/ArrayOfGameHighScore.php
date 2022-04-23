<?php


namespace telegramBotApiPhp\Types;


abstract class ArrayOfGameHighScore
{
    public static function create($data)
    {
        $arrayOfGameHighScore = [];
        foreach ($data as $user) {
            $arrayOfGameHighScore[] = GameHighScore::create($user);
        }

        return $arrayOfGameHighScore;
    }
}