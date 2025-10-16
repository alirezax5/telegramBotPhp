<?php

namespace telegramBotApiPhp\Types;

/**
 * Class OwnedGifts
 *
 * Contains the list of gifts received and owned by a user or a chat.
 *
 * @property int $total_count The total number of gifts owned by the user or the chat
 * @property OwnedGift[] $gifts The list of gifts
 * @property string|null $next_offset Optional. Offset for the next request. If empty, then there are no more results
 */
class OwnedGifts extends BaseType
{
}
