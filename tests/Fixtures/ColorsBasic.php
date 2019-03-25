<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Fixtures;

use Eclipxe\Enum\Enum;

/**
 * This is a use case that will be extended
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
class ColorsBasic extends Enum
{
}
