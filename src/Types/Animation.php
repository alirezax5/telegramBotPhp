<?php

namespace telegramBotApiPhp\Types;

/**
 * Class Animation
 * Represents an animation file (GIF or H.264/MPEG-4 AVC video without sound).
 *
 * @property string $file_id Identifier for downloading or reusing the file.
 * @property string $file_unique_id Unique ID, consistent over time and across bots (not for downloading).
 * @property int $width Video width as defined by the sender.
 * @property int $height Video height as defined by the sender.
 * @property int $duration Duration of the video in seconds.
 * @property PhotoSize|null $thumbnail Optional. Animation thumbnail.
 * @property string|null $file_name Optional. Original filename.
 * @property string|null $mime_type Optional. MIME type of the file.
 * @property int|null $file_size Optional. File size in bytes (up to 52 significant bits).
 */
class Animation extends BaseType
{
}
