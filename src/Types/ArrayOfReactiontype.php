<?php


namespace telegramBotApiPhp\Types;


abstract class ArrayOfReactiontype
{
    public static function create($data)
    {
        $arrayOfReactions = [];
        foreach ($data as $r) {
            $arrayOfReactions[] = Reactiontype::create($r);
        }

        return $arrayOfReactions;
    }
}