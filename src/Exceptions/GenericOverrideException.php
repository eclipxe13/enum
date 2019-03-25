<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Exceptions;

use OutOfRangeException;
use Throwable;

class GenericOverrideException extends OutOfRangeException implements EnumExceptionInterface
{
    protected const TYPE_NAME = '';

    public static function create(string $className, string $value, Throwable $previous = null)
    {
        // StatusEnum cannot override value to x
        return new static(sprintf('%s cannot override %s to %s', $className, static::TYPE_NAME, $value), 0, $previous);
    }
}
