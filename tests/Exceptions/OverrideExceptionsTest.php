<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Exceptions;

use Eclipxe\Enum\Exceptions\IndexOverrideException;
use Eclipxe\Enum\Exceptions\ValueOverrideException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class OverrideExceptionsTest extends TestCase
{
    public function testValueMessage(): void
    {
        $previous = new RuntimeException('dummy');
        $exception = ValueOverrideException::create('CLASS', 'VALUE', $previous);

        $this->assertSame('CLASS cannot override value to VALUE', $exception->getMessage());
        $this->assertSame($previous, $exception->getPrevious());
    }

    public function testIndexMessage(): void
    {
        $previous = new RuntimeException('dummy');
        $exception = IndexOverrideException::create('CLASS', 'INDEX', $previous);

        $this->assertSame('CLASS cannot override index to INDEX', $exception->getMessage());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
