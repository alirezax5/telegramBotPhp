<?php

namespace telegramBotApiPhp\Types;

/**
 * Class Checklist
 *
 *
 * @property string $title    Title of the checklist
 * @property MessageEntity[] $title_entities Special entities that appear in the checklist title
 * @property ChecklistTask[] $tasks List of tasks in the checklist
 * @property bool $others_can_add_tasks True, if users other than the creator of the list can add tasks to the list
 * @property bool $others_can_mark_tasks_as_done if users other than the creator of the list can mark tasks as done or not done
 */
class Checklist extends BaseType
{
}
