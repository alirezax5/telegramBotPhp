<?php
namespace telegramBotApiPhp\Types;

/**
 * Class PassportElementError
 * This object represents an error in the Telegram Passport element which was submitted that should be resolved by the user.
 *
 * @property string $source Error source, must be data
 * @property string $type The section of the user's Telegram Passport which has the error, one of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”
 * @property string $field_name Name of the data field which has the error
 * @property string $data_hash Base64-encoded data hash
 * @property string $message Error message
 * @property string $file_hash Base64-encoded hash of the file with the front side of the document
 * @property string[] $file_hashes List of base64-encoded file hashes
 */
class PassportElementError extends BaseType
{
}
