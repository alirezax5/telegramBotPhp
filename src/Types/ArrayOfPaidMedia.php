<?php


namespace telegramBotApiPhp\Types;


class ArrayOfPaidMedia extends base
{
    public static function create($data)
    {
        $PaidMediaElements = [];
        foreach ($data as $PaidMediaElement) {
            $PaidMediaElements[] = PaidMedia::create($PaidMediaElement);
        }

        return $PaidMediaElements;
    }
}