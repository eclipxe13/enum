<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Exceptions;

class IndexOverrideException extends GenericOverrideException
{
    protected const TYPE_NAME = 'index';
}
