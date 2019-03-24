<?php

declare(strict_types=1);

namespace Eclipxe\Enum;

use InvalidArgumentException;

/**
 * @method string value()
 */
class StringEnum extends AbstractEnum implements EnumInterface
{
    protected static function findValue($value, array $enums): ?string
    {
        if (! is_string($value)) {
            throw new InvalidArgumentException(sprintf('String value is expected to create a %s', static::class));
        }

        // $invertedEnum is now VALUE => NAME
        $invertedEnum = array_change_key_case(array_flip($enums), CASE_UPPER);

        // obtain name
        $upperCaseValue = strtoupper($value);
        $name = $invertedEnum[$upperCaseValue] ?? null;
        if (null === $name) {
            return null;
        }

        // obtain value **from enums**
        return $enums[$name] ?? null;
    }

    protected static function defaultEnumValue(string $name, array $enums): string
    {
        return $name;
    }
}
