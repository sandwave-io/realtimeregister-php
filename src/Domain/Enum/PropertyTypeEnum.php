<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class PropertyTypeEnum extends AbstractEnum
{
    const TYPE_STRING = 'String';
    const TYPE_DATE = 'Date';
    const TYPE_INTEGER = 'Integer';

    protected static $values = [
        PropertyTypeEnum::TYPE_STRING,
        PropertyTypeEnum::TYPE_DATE,
        PropertyTypeEnum::TYPE_INTEGER,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        PropertyTypeEnum::assertValueValid($value);
    }
}
