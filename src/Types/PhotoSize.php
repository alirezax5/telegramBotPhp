<?php

namespace telegramBotApiPhp\Types;

/**
 * Class PhotoSize
 * Represents one size of a photo or a file/sticker thumbnail.
 *
 * @property string $file_id Identifier for downloading or reusing the file.
 * @property string $file_unique_id Unique ID, consistent over time and across bots (not for downloading).
 * @property int $width Photo width.
 * @property int $height Photo height.
 * @property int|null $file_size Optional. File size in bytes.
 */
class PhotoSize extends BaseType
{
}
