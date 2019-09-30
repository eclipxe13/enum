<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Unit;

use Eclipxe\Enum\Tests\Fixtures\ColorsBasic;
use Eclipxe\Enum\Tests\Fixtures\ColorsExtended;
use Eclipxe\Enum\Tests\Fixtures\ColorsExtendedWithBlackAndWhite;
use PHPUnit\Framework\TestCase;

/**
 * This tests are based on Eclipxe\Enum\Tests\Enums\WeekDays
 * Tests should refer to the behavior of extended class
 *
 * @see ColorsBasic
 * @see ColorsExtended
 * @see ColorsExtendedWithBlackAndWhite
 */
class EnumExtendedClassesTest extends TestCase
{
    public function testCreateThirdLevelExtendedClass(): void
    {
        $black = ColorsExtendedWithBlackAndWhite::black();
        $this->assertTrue($black->isBlack(), 'Compare against itself');
        $this->assertFalse($black->isWhite(), 'Compare against sibling');
        $this->assertFalse($black->isYellow(), 'Compare against parent');
        $this->assertFalse($black->isRed(), 'Compare against grand parent');
    }

    public function testEnumMapOnThirdLevelExtendedClass(): void
    {
        $expected = [
            0 => 'red',
            1 => 'green',
            2 => 'blue',
            3 => 'yellow',
            4 => 'magenta',
            5 => 'cyan',
            6 => 'black',
            7 => 'white',
        ];
        $this->assertSame($expected, ColorsExtendedWithBlackAndWhite::toArray());
    }

    public function testCreateSecondLevelExtendedClass(): void
    {
        $cyan = ColorsExtended::cyan();
        $this->assertTrue($cyan->isCyan(), 'Compare against itself');
        $this->assertFalse($cyan->isYellow(), 'Compare against sibling');
        $this->assertFalse($cyan->isRed(), 'Compare against parent');
    }

    public function testEnumMapOnSecondLevelExtendedClass(): void
    {
        $expected = [
            0 => 'red',
            1 => 'green',
            2 => 'blue',
            3 => 'yellow',
            4 => 'magenta',
            5 => 'cyan',
        ];
        $this->assertSame($expected, ColorsExtended::toArray());
    }
}
