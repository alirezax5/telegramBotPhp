<?php
namespace telegramBotApiPhp\Types;

/**
 * Class MaskPosition
 * Describes the position on a face where a mask should be placed.
 *
 * @property string $point Part of the face to place the mask ("forehead", "eyes", "mouth", or "chin")
 * @property float $x_shift Shift on the X-axis (from left to right)
 * @property float $y_shift Shift on the Y-axis (from top to bottom)
 * @property float $scale Mask scaling coefficient (e.g., 2.0 means double size)
 */
class MaskPosition extends BaseType
{
}
