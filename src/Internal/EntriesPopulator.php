<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Internal;

use Eclipxe\Enum\Exceptions\IndexOverrideException;
use Eclipxe\Enum\Exceptions\ValueOverrideException;
use ReflectionClass;

/**
 * This is a helper that perform discovery
 *
 * This is an internal class, do not use it by your own. Changes on this class are not library breaking changes.
 * @internal
 */
class EntriesPopulator
{
    /** @var string */
    private $className;

    /** @var array */
    private $overrideValues;

    /** @var array */
    private $overrideIndices;

    /** @var Entries */
    private $parentEntries;

    public function __construct(
        string $className,
        array $overrideValues,
        array $overrideIndices,
        Entries $parentEntries
    ) {
        $this->className = $className;
        $this->overrideValues = $overrideValues;
        $this->overrideIndices = $overrideIndices;
        $this->parentEntries = $parentEntries;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function populate(Entries $entries): void
    {
        // populate with parents first
        $entries->append($this->parentEntries);

        // populate with discovered
        $names = array_filter(
            $this->resolveNamesFromDocBlocks(),
            function (string $name) use ($entries) {
                return ! $entries->hasName($name);
            }
        );
        foreach ($names as $name) {
            $newValue = $this->overrideValue($name) ?? $name;
            if (null !== $entries->findEntryByValue($newValue)) {
                throw ValueOverrideException::create($this->getClassName(), $newValue);
            }

            $newIndex = $this->overrideIndex($name) ?? $entries->nextIndex();
            if (null !== $entries->findEntryByIndex($newIndex)) {
                throw IndexOverrideException::create($this->getClassName(), strval($newIndex));
            }

            $entries->put($name, new Entry($newValue, $newIndex));
        }
    }

    public function overrideValue(string $name): ?string
    {
        $value = $this->overrideValues[$name] ?? null;
        if (null === $value || ! is_string($value)) {
            return null;
        }
        return $value;
    }

    public function overrideIndex(string $name): ?int
    {
        $index = $this->overrideIndices[$name] ?? null;
        if (null === $index || ! is_int($index)) {
            return null;
        }
        return $index;
    }

    public function resolveNamesFromDocBlocks(): array
    {
        // get comments
        $reflectionClass = new ReflectionClass($this->getClassName());
        $docComment = strval($reflectionClass->getDocComment());
        return $this->resolveNamesFromDocComment($docComment);
    }

    public function resolveNamesFromDocComment(string $docComment): array
    {
        // read declarations @method static self WORD()
        //  [*\t ]*: any asterisk, space or tab
        //  [\w]+: any word letters, numbers and underscore
        //  /m: ^ match beginning of the line
        preg_match_all('/^[*\t ]*@method static (self|static) ([\w]+)\(\)/m', $docComment, $matches);
        return $matches[2] ?? [];
    }
}
