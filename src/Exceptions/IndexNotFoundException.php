<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Exceptions;

use Throwable;

class IndexNotFoundException extends GenericNotFoundException
{
    public static function create(string $className, string $value, Throwable $previous = null): self
    {
        // StatusEnum index x was not found
        return new self(static::formatGenericMessage($className, 'index', $value), 0, $previous);
    }
}
