<?php

namespace telegramBotApiPhp\Types;

/**
 * Class Audio
 * Represents an audio file to be treated as music by Telegram clients.
 *
 * @property string $file_id Identifier for downloading or reusing the file.
 * @property string $file_unique_id Unique ID, consistent over time and across bots (not for downloading).
 * @property int $duration Duration of the audio in seconds.
 * @property string|null $performer Optional. Performer of the audio.
 * @property string|null $title Optional. Title of the audio.
 * @property string|null $file_name Optional. Original filename.
 * @property string|null $mime_type Optional. MIME type of the file.
 * @property int|null $file_size Optional. File size in bytes (up to 52 significant bits).
 * @property PhotoSize|null $thumbnail Optional. Album cover thumbnail.
 */
class Audio extends BaseType
{
}
