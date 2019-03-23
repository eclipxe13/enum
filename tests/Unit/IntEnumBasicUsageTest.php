<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Unit;

use Eclipxe\Enum\Tests\Enums\BasicColors;
use PHPUnit\Framework\TestCase;

class IntEnumBasicUsageTest extends TestCase
{
    public function testEnumValuesWithIndex0(): void
    {
        $red = BasicColors::red();
        $this->assertTrue($red->isRed());
        $this->assertFalse($red->isBlue());
        $this->assertSame(0, $red->value());
        $this->assertSame('0', strval($red), 'Comparison casting to string');
    }

    public function testEnumValuesWithIndex2(): void
    {
        $blue = new BasicColors(2);
        $this->assertTrue($blue->isBlue());
        $this->assertFalse($blue->isRed());
        $this->assertSame(2, $blue->value());
        $this->assertSame('2', strval($blue), 'Comparison casting to string');
    }

    public function testThrowExceptionUsingInvalidType(): void
    {
        // 9 is not a valid value
        $this->expectException(\OutOfBoundsException::class);
        new BasicColors(9);
    }
}
