<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Enums;

use Eclipxe\Enum\IntEnum;

/**
 * This is a common use case enum sample
 *
 * @method static self red()
 * @method static self green()
 * @method static self blue()
 *
 * @method bool isRed()
 * @method bool isGreen()
 * @method bool isBlue()
 *
 */
class BasicColors extends IntEnum
{
}
