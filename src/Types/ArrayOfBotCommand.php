<?php


namespace telegramBotApiPhp\Types;


abstract class ArrayOfBotCommand
{
    public static function create($data)
    {
        $arrayOfUCommand = [];
        foreach ($data as $Command) {
            $arrayOfUCommand[] = BotCommand::create($Command);
        }

        return $arrayOfUCommand;
    }
}