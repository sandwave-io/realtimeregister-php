<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class DomainZoneServiceEnum extends AbstractEnum
{
    public const BASIC = 'BASIC';
    public const PREMIUM = 'PREMIUM';

    protected static array $values = [
        self::BASIC,
        self::PREMIUM,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
