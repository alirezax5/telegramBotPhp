<?php
namespace telegramBotApiPhp\Types;

/**
 * Class RevenueWithdrawalState
 * This object describes the state of a revenue withdrawal operation.
 * Currently, it can be one of:
 * - succeeded: The withdrawal succeeded.
 *
 * @property string $type Type of the state, always “succeeded”
 * @property int $date Date the withdrawal was completed in Unix time
 * @property string $url An HTTPS URL that can be used to see transaction details
 */
class RevenueWithdrawalState extends BaseType
{
}
