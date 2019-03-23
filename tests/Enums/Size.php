<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Enums;

use Eclipxe\Enum\StringEnum;

/**
 * This is a common use case enum sample
 *
 * @method static self small()
 * @method static self medium()
 * @method static self large()
 * @method static self extraLarge()
 * @method static self uni()
 *
 * @method bool isSmall()
 * @method bool isMedium()
 * @method bool isLarge()
 * @method bool isExtraLarge()
 * @method bool isUni()
 */
class Size extends StringEnum
{
    protected static function overrideValueForName(string $name): ?string
    {
        $map = [
            'SMALL' => 's',
            'MEDIUM' => 'm',
            'LARGE' => 'l',
            'EXTRALARGE' => 'xl',
        ];
        return $map[$name] ?? null;
    }
}
