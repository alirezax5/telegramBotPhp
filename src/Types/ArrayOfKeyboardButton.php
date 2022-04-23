<?php


namespace telegramBotApiPhp\Types;


abstract class ArrayOfKeyboardButton
{
    public static function create($data)
    {
        $ArrayOfKeyboardButtonPollType = [];
        foreach ($data as $arr) {
            $ArrayOfKeyboardButtonPollType[] = KeyboardButton::create($arr);
        }

        return $ArrayOfKeyboardButtonPollType;
    }
}