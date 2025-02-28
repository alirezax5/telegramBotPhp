<?php
namespace telegramBotApiPhp\Types;

/**
 * Class SetPassportDataErrors
 * Informs a user that some of the Telegram Passport elements they provided contains errors.
 * The user will not be able to re-submit their Passport to you until the errors are fixed.
 * Returns True on success.
 *
 * @property int $user_id User identifier
 * @property PassportElementError[] $errors A JSON-serialized array describing the errors
 */
class SetPassportDataErrors extends BaseType
{
}
