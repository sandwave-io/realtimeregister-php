<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class LanguageEnum extends AbstractEnum
{
    const ENGLISH = 'EN';
    const DUTCH = 'NL';
    const FRENCH = 'FR';
    const GERMAN = 'DE';

    protected static array $values = [
        self::ENGLISH,
        self::DUTCH,
        self::FRENCH,
        self::GERMAN,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        LanguageEnum::assertValueValid($value);
    }
}
