<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ChatBackground
 * Represents a chat background.
 * /**
 *  BackgroundTypeFill
 *  The background is automatically filled based on the selected colors.
 *
 * @property string $type Type of the background, always “fill”.
 * @property BackgroundFill $fill The background fill.
 * @property int $dark_theme_dimming Dimming of the background in dark themes, as a percentage; 0-100.
 * /
 *
 * /**
 *  BackgroundTypeWallpaper
 *  The background is a wallpaper in the JPEG format.
 *
 * @property bool $is_blurred Optional. True if the wallpaper is downscaled and blurred.
 * @property bool $is_moving Optional. True if the background moves when the device is tilted.
 *
 *
 *
 *  BackgroundTypePattern
 *  The background is a PNG or TGV pattern to be combined with the background fill.
 *
 * @property Document $document Document with the pattern.
 * @property int $intensity Intensity of the pattern when shown above the filled background; 0-100.
 * @property bool $is_inverted Optional. True if the background fill is only applied to the pattern itself.
 *
 */
class ChatBackground extends BaseType
{

}
