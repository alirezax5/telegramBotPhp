<?php


namespace telegramBotApiPhp\Types;


abstract class ArrayOfChatMember
{
    public static function create($data)
    {
        $arrayOfUsers = [];
        foreach ($data as $user) {
            $arrayOfUsers[] = ChatMember::create($user);
        }

        return $arrayOfUsers;
    }
}