<?php

namespace telegramBotApiPhp\Types;

/**
 * Class Document
 * Represents a general file (excluding photos, voice messages, and audio files).
 *
 * @property string $file_id Identifier for downloading or reusing the file.
 * @property string $file_unique_id Unique ID, consistent over time and across bots (not for downloading).
 * @property PhotoSize|null $thumbnail Optional. Document thumbnail.
 * @property string|null $file_name Optional. Original filename.
 * @property string|null $mime_type Optional. MIME type of the file.
 * @property int|null $file_size Optional. File size in bytes (up to 52 significant bits).
 */
class Document extends BaseType
{
}
