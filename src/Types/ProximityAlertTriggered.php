<?php
namespace telegramBotApiPhp\Types;

/**
 * Class ProximityAlertTriggered
 * Represents the content of a service message, sent whenever a user in the chat triggers a proximity alert set by another user.
 *
 * @property User $traveler User that triggered the alert.
 * @property User $watcher User that set the alert.
 * @property int $distance The distance between the users.
 */
class ProximityAlertTriggered extends BaseType
{
}
