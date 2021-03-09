<?php


namespace telegramBotApiPhp\Types;

abstract class ArrayOfPhotoSize
{
    public static function create($data)
    {
        $arrayOfPhotoSize = [];
        foreach ($data as $photoSizeItem) {
            $arrayOfPhotoSize[] = PhotoSize::create($photoSizeItem);
        }

        return $arrayOfPhotoSize;
    }
}