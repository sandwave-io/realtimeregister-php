<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class DomainFeatureEnum extends AbstractEnum
{
    const FEATURE_CREATE = 'CREATE';
    const FEATURE_RENEW = 'RENEW';
    const FEATURE_TRANSFER = 'TRANSFER';
    const FEATURE_RESTORE = 'RESTORE';
    const FEATURE_UPDATE = 'UPDATE';
    const FEATURE_PRIVACY_PROTECT = 'PRIVACY_PROTECT';
    const FEATURE_PUSH_TRANSFER = 'PUSH_TRANSFER';

    protected static array $values = [
        DomainFeatureEnum::FEATURE_CREATE,
        DomainFeatureEnum::FEATURE_RENEW,
        DomainFeatureEnum::FEATURE_TRANSFER,
        DomainFeatureEnum::FEATURE_RESTORE,
        DomainFeatureEnum::FEATURE_UPDATE,
        DomainFeatureEnum::FEATURE_PRIVACY_PROTECT,
        DomainFeatureEnum::FEATURE_PUSH_TRANSFER,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        DomainFeatureEnum::assertValueValid($value);
    }
}
