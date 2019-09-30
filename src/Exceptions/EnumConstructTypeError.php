<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Exceptions;

use Throwable;
use TypeError;

class EnumConstructTypeError extends TypeError implements EnumExceptionInterface
{
    public static function create(string $className, Throwable $previous = null): self
    {
        return new static(
            sprintf('Argument passed to %s must be integer for index or string for value', $className),
            0,
            $previous
        );
    }
}
