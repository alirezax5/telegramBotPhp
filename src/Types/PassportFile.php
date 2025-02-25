<?php
namespace telegramBotApiPhp\Types;

/**
 * Class PassportFile
 * Represents a file uploaded to Telegram Passport.
 * Currently, all Telegram Passport files are in JPEG format when decrypted and don't exceed 10MB.
 *
 * @property string $file_id Identifier for this file, which can be used to download or reuse the file.
 * @property string $file_unique_id Unique identifier for this file, supposed to remain the same over time and for different bots. Can't be used to download or reuse the file.
 * @property int $file_size File size in bytes.
 * @property int $file_date Unix time when the file was uploaded.
 */
class PassportFile extends BaseType
{
}
