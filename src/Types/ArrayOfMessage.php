<?php


namespace telegramBotApiPhp\Types;


abstract class ArrayOfMessage
{
    public static function create($data)
    {
        $arrayOfMessageEntity = [];
        foreach ($data as $messageEntity) {
            $arrayOfMessageEntity[] = Message::create($messageEntity);
        }

        return $arrayOfMessageEntity;
    }
}