<?php

namespace telegramBotApiPhp\Types;

/**
 * Class Contact
 * Represents a phone contact.
 *
 * @property string $phone_number Contact's phone number.
 * @property string $first_name Contact's first name.
 * @property string|null $last_name Optional. Contact's last name.
 * @property int|null $user_id Optional. Contact's user identifier in Telegram.
 * @property string|null $vcard Optional. Additional data about the contact in the form of a vCard.
 */
class Contact extends BaseType
{
}
