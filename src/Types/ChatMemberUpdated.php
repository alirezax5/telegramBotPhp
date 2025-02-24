<?php

namespace telegramBotApiPhp\Types;

/**
 * Class ChatMemberUpdated
 *
 * @property int $message_id شناسه پیام
 * @property User $from فرستنده پیام
 * @property int $date زمان ارسال پیام (Unix timestamp)
 * @property Chat $chat چت مربوط به پیام
 * @property string $text متن پیام
 */
class ChatMemberUpdated extends BaseType
{
}
