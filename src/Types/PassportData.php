<?php
namespace telegramBotApiPhp\Types;

/**
 * Class PassportData
 * Describes Telegram Passport data shared with the bot by the user.
 *
 * @property EncryptedPassportElement[] $data Array with information about documents and other Telegram Passport elements that were shared with the bot.
 * @property EncryptedCredentials $credentials Encrypted credentials required to decrypt the data.
 */
class PassportData extends BaseType
{
}
