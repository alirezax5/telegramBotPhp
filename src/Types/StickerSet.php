<?php
namespace telegramBotApiPhp\Types;

/**
 * Class StickerSet
 * Represents a sticker set.
 *
 * @property string $name Name of the sticker set
 * @property string $title Title of the sticker set
 * @property string $sticker_type Type of stickers in the set ("regular", "mask", "custom_emoji")
 * @property Sticker[] $stickers List of stickers in the set
 * @property PhotoSize $thumbnail Optional. Thumbnail of the sticker set in .WEBP, .TGS, or .WEBM format
 */
class StickerSet extends BaseType
{
}
