<?php

namespace telegramBotApiPhp\Types;

/**
 * Class PollOption
 * Contains information about one answer option in a poll.
 *
 * @property string $text Option text, 1-100 characters.
 * @property MessageEntity[]|null $text_entities Optional. Special entities that appear in the option text. Currently, only custom emoji entities are allowed in poll option texts.
 * @property int $voter_count Number of users that voted for this option.
 */
class PollOption extends BaseType
{
}
