<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class CertificateTypeEnum extends AbstractEnum
{
    const LOCALE_SINGLE_DOMAIN = 'SINGLE_DOMAIN';
    const LOCALE_MULTI_DOMAIN = 'MULTI_DOMAIN';
    const LOCALE_WILDCARD = 'WILDCARD';

    protected static array $values = [
        CertificateTypeEnum::LOCALE_SINGLE_DOMAIN,
        CertificateTypeEnum::LOCALE_MULTI_DOMAIN,
        CertificateTypeEnum::LOCALE_WILDCARD,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        CertificateTypeEnum::assertValueValid($value);
    }
}
