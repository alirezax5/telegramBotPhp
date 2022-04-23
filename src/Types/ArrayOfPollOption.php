<?php


namespace telegramBotApiPhp\Types;


class ArrayOfPollOption
{
    public static function create($data)
    {
        $arrayOPollOption = [];
        foreach ($data as $PollOptionItem) {
            $arrayOPollOption[] = PollOption::create($PollOptionItem);
        }

        return $arrayOPollOption;
    }
}