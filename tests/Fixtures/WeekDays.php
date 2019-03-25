<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Fixtures;

use Eclipxe\Enum\Enum;

/**
 * This is an enum case where names and values are overridden
 *
 * @method static self monday()
 * @method static self tuesday()
 * @method static self wednesday()
 * @method static self thursday()
 * @method static self friday()
 * @method static self saturday()
 * @method static self sunday()
 *
 * @method bool isUni()
 * @method bool isMonday()
 * @method bool isTuesday()
 * @method bool isWednesday()
 * @method bool isThursday()
 * @method bool isFriday()
 * @method bool isSaturday()
 * @method bool isSunday()
 */
class WeekDays extends Enum
{
    protected static function overrideValues(): array
    {
        return [
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
            'saturday' => 'Saturday',
            'sunday' => 'Sunday',
        ];
    }

    protected static function overrideIndices(): array
    {
        return [
            'monday' => 1,
        ];
    }
}
