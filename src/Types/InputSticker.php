<?php
namespace telegramBotApiPhp\Types;

/**
 * Class InputSticker
 * Describes a sticker to be added to a sticker set.
 *
 * @property mixed $sticker The sticker (file_id, HTTP URL, or file to upload)
 * @property string $format Format of the sticker ("static", "animated", "video")
 * @property string[] $emoji_list List of 1-20 emojis associated with the sticker
 * @property MaskPosition $mask_position Optional. Position for mask placement (for "mask" stickers)
 * @property string[] $keywords Optional. List of 0-20 search keywords (for "regular" and "custom_emoji" stickers)
 */
class InputSticker extends BaseType
{
}
