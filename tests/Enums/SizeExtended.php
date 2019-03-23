<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Enums;

/**
 * This is a common use case enum sample
 *
 * @method static self tiny()
 *
 * @method bool isTiny()
 */
class SizeExtended extends Size
{
    protected static function overrideValueForName(string $name): ?string
    {
        $map = [
            'TINY' => 'xs', // this is new!
            'MEDIUM' => 'mm', // this will not be overriden
        ];
        return $map[$name] ?? null;
    }
}
