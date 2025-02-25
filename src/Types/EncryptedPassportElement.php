<?php
namespace telegramBotApiPhp\Types;

/**
 * Class EncryptedPassportElement
 * Describes documents or other Telegram Passport elements shared with the bot by the user.
 *
 * @property string $type Element type. One of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”, “phone_number”, “email”.
 * @property string|null $data Optional. Base64-encoded encrypted Telegram Passport element data provided by the user; available only for certain types.
 * @property string|null $phone_number Optional. User's verified phone number; available only for “phone_number” type.
 * @property string|null $email Optional. User's verified email address; available only for “email” type.
 * @property PassportFile[]|null $files Optional. Array of encrypted files with documents provided by the user; available for specific types.
 * @property PassportFile|null $front_side Optional. Encrypted file with the front side of the document; available only for certain document types.
 * @property PassportFile|null $reverse_side Optional. Encrypted file with the reverse side of the document; available only for specific document types.
 * @property PassportFile|null $selfie Optional. Encrypted file with the selfie of the user holding a document; available for specific document types.
 * @property PassportFile[]|null $translation Optional. Array of encrypted files with translated versions of documents; available for specific types.
 * @property string|null $hash Base64-encoded element hash for using in PassportElementErrorUnspecified.
 */
class EncryptedPassportElement extends BaseType
{
}
