<?php

namespace telegramBotApiPhp\Types;

/**
 * Class ForumTopicCreated
 * Represents a service message about a new forum topic created in the chat.
 *
 * @property string $name Name of the topic.
 * @property int $icon_color Color of the topic icon in RGB format.
 * @property string $icon_custom_emoji_id Optional. Unique identifier of the custom emoji shown as the topic icon.
 */
class ForumTopicCreated extends BaseType
{
}
