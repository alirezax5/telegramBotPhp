<?php

namespace telegramBotApiPhp\Types;

/**
 * Class VideoNote
 * Represents a video message.
 *
 * @property string $file_id Identifier for this file, which can be used to download or reuse the file.
 * @property string $file_unique_id Unique identifier for this file, consistent over time and across bots (not for downloading).
 * @property int $length Video width and height (diameter of the video message) as defined by the sender.
 * @property int $duration Duration of the video in seconds as defined by the sender.
 * @property PhotoSize|null $thumbnail Optional. Video thumbnail.
 * @property int|null $file_size Optional. File size in bytes.
 */
class VideoNote extends BaseType
{
}
