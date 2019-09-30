<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Unit;

use Eclipxe\Enum\Tests\Fixtures\WeekDays;
use PHPUnit\Framework\TestCase;

/**
 * This tests are based on Eclipxe\Enum\Tests\Enums\WeekDays
 * Tests should refer to overriding values or indices.
 *
 * @see WeekDays
 */
class EnumOverrideValuesAndIndicesTest extends TestCase
{
    public function testCreateAnInstanceOfEnum(): void
    {
        $day = WeekDays::wednesday();
        $this->assertSame('Wednesday', $day->value());
        $this->assertSame(3, $day->index());
        $this->assertTrue($day->isWednesday());
    }

    public function testTwoEqualEnumsAreEqual(): void
    {
        $first = WeekDays::wednesday();
        $second = WeekDays::wednesday();
        $this->assertEquals($first, $second);
    }

    public function testCreateFromConstructorUsingValue(): void
    {
        $day = new WeekDays('Sunday');
        $this->assertTrue($day->isSunday());
    }

    public function testCreateFromConstructorUsingIndex(): void
    {
        $day = new WeekDays(7);
        $this->assertTrue($day->isSunday());
    }

    public function testToArrayExport(): void
    {
        $expected = [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday',
        ];
        $this->assertSame($expected, WeekDays::toArray());
    }
}
