<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Unit;

use Eclipxe\Enum\Tests\Enums\WeekDays;
use PHPUnit\Framework\TestCase;

class IntEnumOverrideOneValueTest extends TestCase
{
    public function testEnumValues(): void
    {
        // monday should be 1 and sunday must be 7
        $monday = WeekDays::monday();
        $this->assertSame(1, $monday->value());

        $sunday = WeekDays::sunday();
        $this->assertSame(7, $sunday->value());
    }
}
