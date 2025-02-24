<?php

namespace telegramBotApiPhp\Types;

/**
 * Class PaidMediaPhoto
 * Represents a paid media of type photo.
 *
 * @property string $type Type of the paid media, always “photo”.
 * @property PhotoSize[] $photo The photo in different sizes.
 */
class PaidMediaPhoto extends PaidMedia
{
}
