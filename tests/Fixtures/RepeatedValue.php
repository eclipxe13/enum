<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Fixtures;

use Eclipxe\Enum\Enum;

/**
 * @method static self foo()
 * @method static self bar()
 * @method static self baz()
 */
class RepeatedValue extends Enum
{
    protected static function overrideValues(): array
    {
        return [
            'bar' => 'foo',
        ];
    }
}
