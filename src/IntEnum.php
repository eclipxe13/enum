<?php

declare(strict_types=1);

namespace Eclipxe\Enum;

use InvalidArgumentException;

/**
 * @method int value()
 */
class IntEnum extends AbstractEnum implements EnumInterface
{
    protected static function findValue($value, array $enums): ?int
    {
        if (! is_int($value)) {
            throw new InvalidArgumentException(sprintf('Integer value is expected to create a %s', static::class));
        }

        // $invertedEnum is now VALUE => NAME
        $invertedEnum = array_flip($enums);

        // obtain name
        $name = $invertedEnum[$value] ?? null;
        if (null === $name) {
            return null;
        }

        // obtain value **from enums**
        return $enums[$name] ?? null;
    }

    protected static function defaultEnumValue(string $name, array $enums): int
    {
        if ([] === $enums) {
            return 0;
        }
        return max($enums) + 1;
    }
}
