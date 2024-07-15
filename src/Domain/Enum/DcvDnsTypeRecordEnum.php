<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class DcvDnsTypeRecordEnum extends AbstractEnum
{
    const DNS_TYPE_CNAME = 'CNAME';
    const DNS_TYPE_TXT = 'TXT';

    protected static array $values = [
        self::DNS_TYPE_CNAME,
        self::DNS_TYPE_TXT,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
