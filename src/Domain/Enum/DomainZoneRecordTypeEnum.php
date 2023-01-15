<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class DomainZoneRecordTypeEnum extends AbstractEnum
{
    public const TYPE_A = 'A';
    public const TYPE_AAAA = 'AAAA';
    public const TYPE_ALIAS = 'ALIAS';
    public const TYPE_CAA = 'CAA';
    public const TYPE_CNAME = 'CNAME';
    public const TYPE_HINFO = 'HINFO';
    public const TYPE_MBOXFW = 'MBOXFW';
    public const TYPE_MX = 'MX';
    public const TYPE_NAPTR = 'NAPTR';
    public const TYPE_NS = 'NS';
    public const TYPE_SOA = 'SOA';
    public const TYPE_SRV = 'SRV';
    public const TYPE_TXT = 'TXT';
    public const TYPE_TLSA = 'TLSA';
    public const TYPE_URL = 'URL';

    protected static array $values = [
        self::TYPE_A,
        self::TYPE_AAAA,
        self::TYPE_ALIAS,
        self::TYPE_CAA,
        self::TYPE_CNAME,
        self::TYPE_HINFO,
        self::TYPE_MBOXFW,
        self::TYPE_MX,
        self::TYPE_NAPTR,
        self::TYPE_NS,
        self::TYPE_SOA,
        self::TYPE_SRV,
        self::TYPE_TXT,
        self::TYPE_TLSA,
        self::TYPE_URL,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
