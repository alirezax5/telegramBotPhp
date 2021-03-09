<?php


namespace telegramBotApiPhp\Types;


class ArrayOfPassportFile extends base
{
    public static function create($data)
    {
        $arrayOfPassportFile = [];
        foreach ($data as $PassportFile) {
            $arrayOfPassportFile [] = PassportFile::create($PassportFile);
        }

        return $arrayOfPassportFile;
    }
}