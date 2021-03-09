<?php


namespace telegramBotApiPhp\Types;


abstract class ArrayOfSticker
{
    public static function create($data)
    {
        $arrayOfStickers = [];
        foreach ($data as $sticker) {
            $arrayOfStickers[] = Sticker::create($sticker);
        }

        return $arrayOfStickers;
    }
}