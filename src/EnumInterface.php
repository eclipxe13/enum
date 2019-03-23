<?php

declare(strict_types=1);

namespace Eclipxe\Enum;

interface EnumInterface
{
    /**
     * EnumInterface constructor.
     *
     * @param mixed $value
     *
     * @throws \InvalidArgumentException if value is not in the correct type of enum
     * @throws \OutOfBoundsException if value is not part of the enum
     */
    public function __construct($value);

    /**
     * Returns the current value
     * Is set to mixed to allow covariance
     *
     * @return mixed
     */
    public function value();

    /**
     * @param string $name
     * @return static|null
     */
    public static function createFromName(string $name);

    /**
     * @return array<string, mixed>
     */
    public static function currentEnums(): array;
}
