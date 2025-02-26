<?php
namespace telegramBotApiPhp\Types;

/**
 * Class InputPollOption
 * Contains information about one answer option in a poll to be sent.
 *
 * @property string $text Option text, 1-100 characters.
 * @property string $text_parse_mode Optional. Mode for parsing entities in the text. See formatting options for more details. Currently, only custom emoji entities are allowed.
 * @property MessageEntity[] $text_entities Optional. A JSON-serialized list of special entities that appear in the poll option text. It can be specified instead of text_parse_mode.
 */
class InputPollOption extends BaseType
{
}
