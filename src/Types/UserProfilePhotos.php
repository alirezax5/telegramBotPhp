<?php
namespace telegramBotApiPhp\Types;

/**
 * Class UserProfilePhotos
 * Represents a user's profile pictures.
 *
 * @property int $total_count Total number of profile pictures the user has
 * @property PhotoSize[][] $photos List of requested profile pictures (up to 4 sizes each)
 */
class UserProfilePhotos extends BaseType
{
}
