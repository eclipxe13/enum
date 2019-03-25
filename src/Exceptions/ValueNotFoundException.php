<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Exceptions;

class ValueNotFoundException extends GenericNotFoundException
{
    protected const TYPE_NAME = 'value';
}
