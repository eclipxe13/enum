<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Unit;

use Eclipxe\Enum\Tests\Enums\Size;
use PHPUnit\Framework\TestCase;

class StringEnumCanOverrideItsValuesTest extends TestCase
{
    public function testCreateUsingValue(): void
    {
        $sizeXl = new Size('XL');
        $this->assertSame('xl', $sizeXl->value());
    }

    public function testCreateUsingName(): void
    {
        $sizeXl = Size::extraLarge();
        $this->assertSame('xl', $sizeXl->value());
    }

    public function testCreateUsingNameAsValueProducesException(): void
    {
        $this->expectException(\OutOfBoundsException::class);
        new Size('extraLarge');
    }

    public function testCreateIsMagicMethod(): void
    {
        $sizeXl = Size::extraLarge();
        $this->assertTrue($sizeXl->isExtraLarge());
    }

    public function testUndefinedOverrideTakesName(): void
    {
        $size = Size::uni();
        $this->assertSame('uni', $size->value());
    }
}
