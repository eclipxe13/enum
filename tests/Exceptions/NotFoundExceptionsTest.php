<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Exceptions;

use Eclipxe\Enum\Exceptions\IndexNotFoundException;
use Eclipxe\Enum\Exceptions\ValueNotFoundException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class NotFoundExceptionsTest extends TestCase
{
    public function testValueMessage(): void
    {
        $previous = new RuntimeException('dummy');
        $exception = ValueNotFoundException::create('CLASS', 'VALUE', $previous);

        $this->assertSame('CLASS value VALUE was not found', $exception->getMessage());
        $this->assertSame($previous, $exception->getPrevious());
    }

    public function testIndexMessage(): void
    {
        $previous = new RuntimeException('dummy');
        $exception = IndexNotFoundException::create('CLASS', 'INDEX', $previous);

        $this->assertSame('CLASS index INDEX was not found', $exception->getMessage());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
