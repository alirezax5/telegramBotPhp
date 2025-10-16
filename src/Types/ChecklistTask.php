<?php

namespace telegramBotApiPhp\Types;

/**
 * Class ChatBoost
 * Contains information about a chat boost.
 *
 * @property int $id     Unique identifier of the task
 * @property string $text Text of the task
 * @property MessageEntity[] $text_entities Optional. Special entities that appear in the task text
 * @property User $completed_by_user Source Optional. User that completed the task; omitted if the task wasn't completed
 * @property int $completion_date Optional. Point in time (Unix timestamp) when the task was completed; 0 if the task wasn't completed
 */
class ChecklistTask extends BaseType
{
}
