<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Tests\Fixtures;

use Eclipxe\Enum\Enum;

/**
 * This is a common use case enum sample
 *
 * @method static self created()
 * @method static self published()
 * @method static self reviewed()
 * @method static self purged()
 *
 * @method bool isCreated()
 * @method bool isPublished()
 * @method bool isReviewed()
 * @method bool isPurged()
 */
class Stages extends Enum
{
}
