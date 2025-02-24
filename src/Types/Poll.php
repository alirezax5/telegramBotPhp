<?php

namespace telegramBotApiPhp\Types;

/**
 * Class Poll
 * Contains information about a poll.
 *
 * @property string $id Unique poll identifier.
 * @property string $question Poll question, 1-300 characters.
 * @property MessageEntity[]|null $question_entities Optional. Special entities that appear in the question. Currently, only custom emoji entities are allowed in poll questions.
 * @property PollOption[] $options List of poll options.
 * @property int $total_voter_count Total number of users that voted in the poll.
 * @property bool $is_closed True, if the poll is closed.
 * @property bool $is_anonymous True, if the poll is anonymous.
 * @property string $type Poll type, currently can be “regular” or “quiz”.
 * @property bool $allows_multiple_answers True, if the poll allows multiple answers.
 * @property int|null $correct_option_id Optional. 0-based identifier of the correct answer option. Available only for polls in quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
 * @property string|null $explanation Optional. Text shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters.
 * @property MessageEntity[]|null $explanation_entities Optional. Special entities like usernames, URLs, bot commands, etc. that appear in the explanation.
 * @property int|null $open_period Optional. Amount of time in seconds the poll will be active after creation.
 * @property int|null $close_date Optional. Point in time (Unix timestamp) when the poll will be automatically closed.
 */
class Poll extends BaseType
{
}
