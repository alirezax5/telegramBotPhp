<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ResponseParameters
 * Describes why a request was unsuccessful.
 *
 * @property int $migrate_to_chat_id Optional. ID of the supergroup the chat was migrated to
 * @property int $retry_after Optional. Seconds to wait before retrying due to flood control
 */
class ResponseParameters extends BaseType
{
}
