<?php


namespace telegramBotApiPhp\Types;


abstract class ArrayOfArrayOfPhotoSize
{
    public static function create($data)
    {
        $ArrayOfArrayOfPhotoSize = [];
        foreach ($data as $photoSizeItem) {
            $ArrayOfArrayOfPhotoSize[] = ArrayOfPhotoSize::create($photoSizeItem);
        }

        return $ArrayOfArrayOfPhotoSize;
    }
}