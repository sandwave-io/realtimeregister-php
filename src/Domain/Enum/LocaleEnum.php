<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class LocaleEnum extends AbstractEnum
{
    const LOCALE_EN_US = 'en-US';
    const LOCALE_NL_NL = 'nl-NL';

    protected static array $values = [
        LocaleEnum::LOCALE_EN_US,
        LocaleEnum::LOCALE_NL_NL,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        LocaleEnum::assertValueValid($value);
    }
}
