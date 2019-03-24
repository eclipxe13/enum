<?php

declare(strict_types=1);

namespace Eclipxe\Enum;

use BadMethodCallException;
use InvalidArgumentException;
use OutOfBoundsException;
use ReflectionClass;

abstract class AbstractEnum implements EnumInterface
{
    /** @var mixed */
    protected $value;

    public function value()
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return strval($this->value);
    }

    public function __construct($value)
    {
        $newValue = static::findValue($value, static::currentEnums());
        if (null === $newValue) {
            throw new OutOfBoundsException(sprintf('Value %s is not part of %s', $value, static::class));
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

    /**
     * Find a value according to name
     * @param mixed $value
     * @param array<string, mixed> $enums
     * @return mixed|null NULL if value was not found
     * @throws InvalidArgumentException indicating that type is incorrect to static::class
     */
    abstract protected static function findValue($value, array $enums);

    /**
     * @param string $name
     * @return static|null
     */
    final public static function createFromName(string $name): ?self
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
     * @return array<string, mixed>
     */
    final public static function currentEnums(): array
    {
        /**
         * Contains the list of current enums elements as <class> => [<name> => <value>], example:
         * DocumentEnum => [
         *     DRAFT => draft,
         *     PUBLISHED => published,
         * ]
         *
         * Store the information in class name because it will collide with parents
         */
        static $enums = [];

        // resolve to current enums
        if (! isset($enums[static::class])) {
            $enums[static::class] = static::resolveEnums();
        }
        return $enums[static::class];
    }

    protected static function resolveParentEnums(ReflectionClass $thisClass): array
    {
        $enums = [];
        $parentClass = $thisClass->getParentClass();
        while ($parentClass instanceof ReflectionClass && $parentClass->isInstantiable()) {
            $enums = array_merge($enums, $parentClass->getName()::{'currentEnums'}());
            $parentClass = $parentClass->getParentClass();
        }
        return $enums;
    }

    final protected static function resolveEnums(): array
    {
        $thisClass = new ReflectionClass(static::class);

        // populate enums with parents
        $enums = self::resolveParentEnums($thisClass);

        // detect names defined in this class
        $names = static::resolveNamesFromDocBlocks($thisClass);
        foreach ($names as $name) {
            $key = strtoupper($name);
            if (! array_key_exists($key, $enums)) { // only set if it was not defined in parents
                $enums[$key] = static::overrideValueForName($key) ?? static::defaultEnumValue($name, $enums);
            }
        }

        return $enums;
    }

    /**
     * @param string $name
     * @param array $enums
     * @return mixed
     */
    abstract protected static function defaultEnumValue(string $name, array $enums);

    /**
     * This method will retun an array of names declared in docblocks in the form:
     * `* method static self <name>()`
     *
     * @param ReflectionClass $reflectionClass
     *
     * @return array
     */
    final protected static function resolveNamesFromDocBlocks(ReflectionClass $reflectionClass): array
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

    /**
     * @param string $name
     * @return mixed|null
     */
    protected static function overrideValueForName(string $name)
    {
        unset($name); // do something with name to avoid style and code analysis warnings
        return null;
    }
}
