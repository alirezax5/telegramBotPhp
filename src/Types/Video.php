<?php

namespace telegramBotApiPhp\Types;

/**
 * Class Video
 * Represents a video file.
 *
 * @property string $file_id Identifier for this file, which can be used to download or reuse the file.
 * @property string $file_unique_id Unique identifier for this file, consistent over time and across bots (not for downloading).
 * @property int $width Video width as defined by the sender.
 * @property int $height Video height as defined by the sender.
 * @property int $duration Duration of the video in seconds as defined by the sender.
 * @property PhotoSize|null $thumbnail Optional. Video thumbnail.
 * @property PhotoSize[]|null $cover Optional. Available sizes of the cover of the video.
 * @property int|null $start_timestamp Optional. Timestamp in seconds from which the video will play in the message.
 * @property string|null $file_name Optional. Original filename as defined by the sender.
 * @property string|null $mime_type Optional. MIME type of the file as defined by the sender.
 * @property int|null $file_size Optional. File size in bytes.
 */
class Video extends BaseType
{
}
