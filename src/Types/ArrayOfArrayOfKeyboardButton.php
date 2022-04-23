<?php


namespace telegramBotApiPhp\Types;


abstract class ArrayOfArrayOfKeyboardButton
{
    public static function create($data)
    {
        $ArrayOfArrayOf = [];
        foreach ($data as $arr) {
            $ArrayOfArrayOf[] = ArrayOfKeyboardButton::create($arr);
        }

        return $ArrayOfArrayOf;
    }
}