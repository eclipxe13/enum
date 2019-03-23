<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Enums;

use Eclipxe\Enum\IntEnum;

/**
 * This is a common use case enum sample
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
class WeekDays extends IntEnum
{
    protected static function overrideValueForName(string $name): ?int
    {
        $map = [
            'MONDAY' => 1,
        ];
        return $map[$name] ?? null;
    }
}
