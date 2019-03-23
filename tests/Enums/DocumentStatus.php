<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Enums;

use Eclipxe\Enum\StringEnum;

/**
 * This is a common use case enum sample
 *
 * @method static self draft()
 * @method static self review()
 * @method static self archive()
 *
 * @method bool isDraft()
 * @method bool isReview()
 * @method bool isArchive()
 */
class DocumentStatus extends StringEnum
{
}
