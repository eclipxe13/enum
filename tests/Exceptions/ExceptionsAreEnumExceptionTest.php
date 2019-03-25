<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Exceptions;

use Eclipxe\Enum\Exceptions\BadMethodCallException;
use Eclipxe\Enum\Exceptions\EnumConstructTypeError;
use Eclipxe\Enum\Exceptions\EnumExceptionInterface;
use Eclipxe\Enum\Exceptions\GenericNotFoundException;
use Eclipxe\Enum\Exceptions\GenericOverrideException;
use Eclipxe\Enum\Exceptions\IndexNotFoundException;
use Eclipxe\Enum\Exceptions\IndexOverrideException;
use Eclipxe\Enum\Exceptions\ValueNotFoundException;
use Eclipxe\Enum\Exceptions\ValueOverrideException;
use PHPUnit\Framework\TestCase;

class ExceptionsAreEnumExceptionTest extends TestCase
{
    public function testAllExceptionsImplementsEnumException(): void
    {
        $exceptions = [
            new BadMethodCallException(),
            new EnumConstructTypeError(),
            new GenericNotFoundException(),
            new ValueNotFoundException(),
            new IndexNotFoundException(),
            new GenericOverrideException(),
            new ValueOverrideException(),
            new IndexOverrideException(),
        ];
        foreach ($exceptions as $exception) {
            $this->assertInstanceOf(EnumExceptionInterface::class, $exception);
        }
    }
}
