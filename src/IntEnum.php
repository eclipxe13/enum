<?php

declare(strict_types=1);

namespace Eclipxe\Enum;

use BadMethodCallException;
use InvalidArgumentException;
use OutOfBoundsException;
use ReflectionClass;

class IntEnum implements EnumInterface
{
    /** @var int */
    private $value;

    public function value(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return strval($this->value);
    }

    public function __construct($value)
    {
        if (! is_int($value)) {
            throw new InvalidArgumentException(sprintf('Integer value is expected to create a %s', static::class));
        }

        $newValue = static::findValue($value);
        if (null === $newValue) {
            throw new OutOfBoundsException(sprintf('Value %d is not part of %s', $value, static::class));
        }

        $this->value = $newValue;
    }

    public function __call($name, $arguments)
    {
        if (strlen($name) > 2 && 0 === strpos($name, 'is')) {
            $created = $this::createFromName(substr($name, 2));
            return (null !== $created && $created->value === $this->value);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method %s->%s()', static::class, $name));
    }

    public static function __callStatic($name, $arguments)
    {
        $created = static::createFromName($name);
        if (null !== $created) {
            return $created;
        }

        throw new BadMethodCallException(sprintf('Call to undefined method %s::%s()', static::class, $name));
    }

    private static function findValue(int $value): ?int
    {
        $enums = static::currentEnums();

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

    public static function createFromName(string $name): ?self
    {
        $enums = static::currentEnums();
        $key = strtoupper($name);
        $value = $enums[$key] ?? null;
        if (null === $value) {
            return null;
        }

        return new static($value);
    }

    /**
     * @return array<string, int>
     */
    public static function currentEnums(): array
    {
        /**
         * Contains the list of current enums elements as <class> => [<name> => <value>], example:
         * WeekDays => [
         *     MONDAY => 1,
         *     TUESDAY => 2,
         *     ...
         * ]
         *
         * Store the information in class name because it will collide with parents
         */
        static $enums = [];

        // resolve to current enums
        if (! isset($enums[static::class])) {
            $enums[static::class] = self::resolveEnums();
        }
        return $enums[static::class];
    }

    private static function resolveEnums(): array
    {
        $enums = [];
        $thisClass = new ReflectionClass(static::class);

        // populate enums with parents
        $parentClass = $thisClass->getParentClass();
        while ($parentClass instanceof ReflectionClass && $parentClass->isInstantiable()) {
            $enums = array_merge($enums, $parentClass->getName()::{'currentEnums'}());
            $parentClass = $parentClass->getParentClass();
        }

        // detect names defined in this class
        $names = static::resolveNamesFromDocBlocks($thisClass);
        foreach ($names as $name) {
            $key = strtoupper($name);
            if (! array_key_exists($key, $enums)) { // only set if it was not defined in parents
                $enums[$key] = static::overrideValueForName($key) ?? (([] === $enums) ? 0 : max($enums) + 1);
            }
        }

        return $enums;
    }

    /**
     * This method will retun an array of names declared in docblocks in the form:
     * `* method static self <name>()`
     *
     * @param ReflectionClass $reflectionClass
     *
     * @return array
     */
    private static function resolveNamesFromDocBlocks(ReflectionClass $reflectionClass): array
    {
        // get comments
        $docComment = $reflectionClass->getDocComment();
        if (! $docComment) {
            return [];
        }

        // read declarations, store in $values
        preg_match_all('/\@method static self ([\w]+)\(\)/', $docComment, $matches);
        $values = $matches[1] ?? [];

        return $values;
    }

    protected static function overrideValueForName(string $name): ?int
    {
        unset($name); // do something with name to avoid style and code analysis warnings
        return null;
    }
}
