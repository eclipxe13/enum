<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Unit;

use Eclipxe\Enum\Tests\Enums\Size;
use Eclipxe\Enum\Tests\Enums\SizeExtended;
use PHPUnit\Framework\TestCase;

class StringEnumExtendedClassTest extends TestCase
{
    public function testExtendedClassCanInstantiateItsOwnElement(): void
    {
        $tiny = SizeExtended::tiny();
        $this->assertTrue($tiny->isTiny());
    }

    public function testExtendedClassCanInstantiateParentElement(): void
    {
        $small = SizeExtended::small();
        $this->assertTrue($small->isSmall());
        $this->assertFalse($small->{'isTiny'}());
    }

    public function testExtendedClassCannotOverrideParentValues(): void
    {
        $extendedMedium = SizeExtended::medium();
        $this->assertTrue($extendedMedium->isMedium());
        $this->assertNotSame('mm', $extendedMedium->isMedium());

        $this->assertSame(Size::medium()->value(), $extendedMedium->value());
    }

    public function testExtendedClassContainsParentEnums(): void
    {
        $enums = SizeExtended::currentEnums();

        $this->assertArrayHasKey('TINY', $enums);
        $this->assertArrayHasKey('SMALL', $enums);
    }
}
