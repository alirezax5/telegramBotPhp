<?php

namespace telegramBotApiPhp\Types;

/**
 * Class BackgroundFill
 * Represents a chat background.
 *
 *  BackgroundTypeFill
 *  The background is automatically filled based on the selected colors.
 *
 * @property string $type Type of the background, always “fill”.
 * @property BackgroundFill $fill The background fill.
 * @property int $dark_theme_dimming Dimming of the background in dark themes, as a percentage; 0-100.
 *
 *  BackgroundTypeWallpaper
 *  The background is a wallpaper in the JPEG format.
 *
 * @property Document $document The document with the wallpaper.
 * @property bool $is_blurred Optional. True, if the wallpaper is downscaled to fit in a 450x450 square and then box-blurred with radius 12.
 * @property bool $is_moving Optional. True, if the background moves slightly when the device is tilted.
 *
 *  BackgroundTypePattern
 *  The background is a PNG or TGV pattern to be combined with the background fill.
 *
 * @property int $intensity Intensity of the pattern when shown above the filled background; 0-100.
 * @property bool $is_inverted Optional. True, if the background fill must be applied only to the pattern itself. All other pixels are black in this case. For dark themes only.
 */
class BackgroundFill extends BaseType
{

}
