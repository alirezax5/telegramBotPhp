<?php

namespace telegramBotApiPhp\Types;

/**
 * Class Sticker
 * Represents a sticker.
 *
 * @property string $file_id Identifier for downloading or reusing the file.
 * @property string $file_unique_id Unique ID, consistent over time and across bots (not for downloading).
 * @property string $type Type of the sticker, can be “regular”, “mask”, or “custom_emoji”.
 * @property int $width Sticker width.
 * @property int $height Sticker height.
 * @property bool $is_animated True if the sticker is animated.
 * @property bool $is_video True if the sticker is a video sticker.
 * @property PhotoSize|null $thumbnail Optional. Sticker thumbnail in .WEBP or .JPG format.
 * @property string|null $emoji Optional. Emoji associated with the sticker.
 * @property string|null $set_name Optional. Name of the sticker set to which the sticker belongs.
 * @property File|null $premium_animation Optional. For premium regular stickers, premium animation.
 * @property MaskPosition|null $mask_position Optional. For mask stickers, the position of the mask.
 * @property string|null $custom_emoji_id Optional. Unique ID for custom emoji stickers.
 * @property bool|null $needs_repainting Optional. True if the sticker needs to be repainted.
 * @property int|null $file_size Optional. File size in bytes.
 */
class Sticker extends BaseType
{
}
