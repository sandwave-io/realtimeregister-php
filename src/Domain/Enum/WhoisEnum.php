<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class WhoisEnum extends AbstractEnum
{
    const WHOIS_WAITING = 'WAITING';
    const WHOIS_ATTENTION = 'ATTENTION';

    const WHOIS_VALIDATED = 'VALIDATED';

    protected static array $values = [
        self::WHOIS_WAITING,
        self::WHOIS_ATTENTION,
        self::WHOIS_VALIDATED,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
