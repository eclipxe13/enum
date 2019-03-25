<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Exceptions;

use OutOfRangeException;
use Throwable;

class GenericNotFoundException extends OutOfRangeException implements EnumExceptionInterface
{
    protected const TYPE_NAME = '';

    public static function create(string $className, string $value, Throwable $previous = null)
    {
        // StatusEnum value x was not found
        return new static(sprintf('%s %s %s was not found', $className, static::TYPE_NAME, $value), 0, $previous);
    }
}
