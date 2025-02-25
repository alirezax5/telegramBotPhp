<?php
namespace telegramBotApiPhp\Types;

/**
 * Class EncryptedCredentials
 * Describes data required for decrypting and authenticating EncryptedPassportElement.
 * See the Telegram Passport Documentation for a complete description of the data decryption and authentication processes.
 *
 * @property string $data Base64-encoded encrypted JSON-serialized data with the unique user's payload, data hashes, and secrets required for EncryptedPassportElement decryption and authentication.
 * @property string $hash Base64-encoded data hash for data authentication.
 * @property string $secret Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption.
 */
class EncryptedCredentials extends BaseType
{
}
