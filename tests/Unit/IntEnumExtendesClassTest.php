<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Unit;

use Eclipxe\Enum\Tests\Enums\ExtendedColors;
use PHPUnit\Framework\TestCase;

class IntEnumExtendesClassTest extends TestCase
{
    public function testIndexesArePreserved(): void
    {
        $blue = ExtendedColors::blue();
        $yellow = ExtendedColors::yellow();
        $this->assertSame(2, $blue->value());
        $this->assertSame(3, $yellow->value());
    }
}
