<?php

namespace telegramBotApiPhp\Types;

/**
 * Class PaidMediaPreview
 * Represents a preview of paid media before payment.
 *
 * @property string $type Type of the paid media, always “preview”.
 * @property int|null $width Optional. Media width as defined by the sender.
 * @property int|null $height Optional. Media height as defined by the sender.
 * @property int|null $duration Optional. Duration of the media in seconds.
 */
class PaidMediaPreview extends PaidMedia
{
}
