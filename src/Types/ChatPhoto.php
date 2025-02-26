<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ChatPhoto
 * Represents a chat photo with small and big versions.
 * Contains file identifiers for both versions.
 *
 * @property string $small_file_id File identifier of small (160x160) chat photo
 * @property string $small_file_unique_id Unique file identifier of small (160x160) chat photo
 * @property string $big_file_id File identifier of big (640x640) chat photo
 * @property string $big_file_unique_id Unique file identifier of big (640x640) chat photo
 */
class ChatPhoto extends BaseType
{
}
