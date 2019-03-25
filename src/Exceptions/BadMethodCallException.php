<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Exceptions;

use BadMethodCallException as PhpBadMethodCallException;
use Throwable;

class BadMethodCallException extends PhpBadMethodCallException implements EnumExceptionInterface
{
    public static function create(string $className, string $methodName, Throwable $previous = null)
    {
        return new static(
            sprintf('Call to undefined method %s::%s', $className, $methodName),
            0,
            $previous
        );
    }
}
