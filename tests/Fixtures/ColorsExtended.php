<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Fixtures;

/**
 * This is a use case that extends from ColorsBasic and will be extended
 *
 * @method static static green() this one must be ignored as it already exists on base class
 *
 * @method static static yellow()
 * @method static static magenta()
 * @method static static cyan()
 *
 * @method bool isYellow()
 * @method bool isMagenta()
 * @method bool isCyan()
 */
class ColorsExtended extends ColorsBasic
{
}
