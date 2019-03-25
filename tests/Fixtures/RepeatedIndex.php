<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Fixtures;

use Eclipxe\Enum\Enum;

/**
 * @method static self foo()
 * @method static self bar()
 * @method static self baz()
 */
class RepeatedIndex extends Enum
{
    protected static function overrideIndices(): array
    {
        return [
            'baz' => 1,
        ];
    }
}
