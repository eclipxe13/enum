<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Exceptions;

class IndexNotFoundException extends GenericNotFoundException
{
    protected const TYPE_NAME = 'index';
}
