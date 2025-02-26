<?php
namespace telegramBotApiPhp\Types;

/**
 * Class BusinessOpeningHours
 * Describes the opening hours of a business.
 *
 * @property string $time_zone_name Unique name of the time zone for which the opening hours are defined.
 * @property BusinessOpeningHoursInterval[] $opening_hours Array of BusinessOpeningHoursInterval.
 */
class BusinessOpeningHours extends BaseType
{
}
