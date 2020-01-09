<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Exceptions;

use OutOfRangeException;
use Throwable;

abstract class GenericNotFoundException extends OutOfRangeException implements EnumExceptionInterface
{
    /**
     * @param string $className
     * @param string $value
     * @param Throwable|null $previous
     * @return static
     */
    abstract public static function create(string $className, string $value, Throwable $previous = null);

    protected static function formatGenericMessage(string $className, string $typeName, string $value): string
    {
        return sprintf('%s %s %s was not found', $className, $typeName, $value);
    }
}
