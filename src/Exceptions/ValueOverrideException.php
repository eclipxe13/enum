<?php

declare(strict_types=1);

namespace Eclipxe\Enum\Exceptions;

class ValueOverrideException extends GenericOverrideException
{
    protected const TYPE_NAME = 'value';
}
