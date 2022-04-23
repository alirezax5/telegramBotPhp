<?php


namespace telegramBotApiPhp\Types;


class ArrayOfEncryptedPassportElement extends base
{
    public static function create($data)
    {
        $ArrayOfEncryptedPassportElement = [];
        foreach ($data as $EncryptedPassportElement) {
            $ArrayOfEncryptedPassportElement[] = EncryptedPassportElement::create($EncryptedPassportElement);
        }

        return $ArrayOfEncryptedPassportElement;
    }
}