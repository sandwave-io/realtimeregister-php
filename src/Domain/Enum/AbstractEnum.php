<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

use SandwaveIo\RealtimeRegister\Exceptions\InvalidArgumentException;

abstract class AbstractEnum
{
    /** @var array */
    protected static $values = [];

    /** @param mixed $value */
    abstract public static function validate($value): void;

    /** @param mixed $value */
    protected static function assertValueValid($value): void
    {
        if (! in_array($value, static::$values)) {
            throw new InvalidArgumentException(sprintf(
                'Unexpected ENUM value in in class %s: %s. Possible values: (%s)',
                static::class,
                $value,
                implode(', ', static::$values)
            ));
        }
    }
}
