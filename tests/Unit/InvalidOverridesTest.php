<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Unit;

use Eclipxe\Enum\Exceptions\IndexOverrideException;
use Eclipxe\Enum\Exceptions\ValueOverrideException;
use Eclipxe\Enum\Tests\Fixtures\RepeatedIndex;
use Eclipxe\Enum\Tests\Fixtures\RepeatedValue;
use PHPUnit\Framework\TestCase;

/**
 * This tests are based on Eclipxe\Enum\Tests\Enums\RepeatedValue
 * Tests should refer to catch error conditions.
 *
 * @see RepeatedValue
 * @see RepeatedIndex
 */
class InvalidOverridesTest extends TestCase
{
    public function testThowsValueOverrideExceptionOnInvalidClassDefinition(): void
    {
        // it does not matter what you want to do with the enum class, it must throw exception anyway
        $this->expectException(ValueOverrideException::class);
        $this->expectExceptionMessage(sprintf('%s cannot override value to foo', RepeatedValue::class));
        new RepeatedValue(0);
    }

    public function testThowsIndexOverrideExceptionOnInvalidClassDefinition(): void
    {
        // it does not matter what you want to do with the enum class, it must throw exception anyway
        $this->expectException(IndexOverrideException::class);
        $this->expectExceptionMessage(sprintf('%s cannot override index to 1', RepeatedIndex::class));
        new RepeatedIndex('foo');
    }
}
