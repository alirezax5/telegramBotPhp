<?php
namespace telegramBotApiPhp\Types;

/**
 * Class Voice
 * Represents a voice note.
 *
 * @property string $file_id Identifier for this file, which can be used to download or reuse the file.
 * @property string $file_unique_id Unique identifier for this file, consistent over time and across bots (not for downloading).
 * @property int $duration Duration of the audio in seconds as defined by the sender.
 * @property string|null $mime_type Optional. MIME type of the file as defined by the sender.
 * @property int|null $file_size Optional. File size in bytes.
 */
class Voice extends BaseType
{
}