<?php


namespace telegramBotApiPhp\Types;

/**
 * Class PollAnswer
 * This object represents an answer of a user in a non-anonymous poll.
 *
 * @property string $poll_id Unique identifier of the poll.
 * @property User $user The user who changed the answer.
 * @property int[] $option_ids Zero-based identifiers of chosen answer options.
 */
class PollAnswer extends BaseType
{

}
