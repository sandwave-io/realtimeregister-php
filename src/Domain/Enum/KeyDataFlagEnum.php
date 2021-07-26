<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class KeyDataFlagEnum extends AbstractEnum
{
    const FLAG_ZSK = 256;
    const FLAG_KSK = 257;

    protected static array $values = [
        KeyDataFlagEnum::FLAG_ZSK,
        KeyDataFlagEnum::FLAG_KSK,
    ];

    /** @param int $value */
    public static function validate($value): void
    {
        KeyDataFlagEnum::assertValueValid($value);
    }
}
