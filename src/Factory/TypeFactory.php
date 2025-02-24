<?php

namespace TelegramBotApiPhp\Factory;

use TelegramBotApiPhp\Types\{
    Message\Message,
    Message\BusinessMessage,
    Message\EditedMessage,
    Inline\InlineQuery,
    Inline\ChosenInlineResult,
    Poll\Poll,
    Poll\PollAnswer,
    Payment\PreCheckoutQuery,
    Payment\ShippingQuery,
    Chat\ChatMember,
    Chat\ChatJoinRequest,
    // سایر کلاس‌ها...
};

class TypeFactory
{
    private const TYPE_MAP = [
        'message' => Message::class,
        'edited_message' => EditedMessage::class,
        'business_message' => BusinessMessage::class,
        'inline_query' => InlineQuery::class,
        'chosen_inline_result' => ChosenInlineResult::class,
        'poll' => Poll::class,
        'poll_answer' => PollAnswer::class,
        'pre_checkout_query' => PreCheckoutQuery::class,
        'shipping_query' => ShippingQuery::class,
        'chat_member' => ChatMember::class,
        'chat_join_request' => ChatJoinRequest::class,
        // سایر مپینگ‌ها...
    ];

    public static function create(string $type, array $data)
    {
        if (!isset(self::TYPE_MAP[$type])) {
            throw new \InvalidArgumentException("Unknown type: $type");
        }

        $className = self::TYPE_MAP[$type];
        return $className::create($data);
    }
}