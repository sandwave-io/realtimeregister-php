<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class FeatureEnum extends AbstractEnum
{
    const FEATURE_REISSUE = 'REISSUE';
    const FEATURE_WILDCARD = 'WILDCARD';
    const FEATURE_WWW_INCLUDED = 'WWW_INCLUDED';
    const FEATURE_NON_WWW_INCLUDED = 'NON_WWW_INCLUDED';

    protected static array $values = [
        FeatureEnum::FEATURE_REISSUE,
        FeatureEnum::FEATURE_WILDCARD,
        FeatureEnum::FEATURE_WWW_INCLUDED,
        FeatureEnum::FEATURE_NON_WWW_INCLUDED,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        FeatureEnum::assertValueValid($value);
    }
}
