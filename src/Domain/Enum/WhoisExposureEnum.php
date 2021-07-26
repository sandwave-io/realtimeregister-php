<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class WhoisExposureEnum extends AbstractEnum
{
    const EXPOSURE_NONE = 'NONE';
    const EXPOSURE_LIMITED = 'LIMITED';
    const EXPOSURE_FULL = 'FULL';
    const EXPOSURE_UNKNOWN = 'UNKNOWN';

    protected static array $values = [
        WhoisExposureEnum::EXPOSURE_NONE,
        WhoisExposureEnum::EXPOSURE_LIMITED,
        WhoisExposureEnum::EXPOSURE_FULL,
        WhoisExposureEnum::EXPOSURE_UNKNOWN,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        WhoisExposureEnum::assertValueValid($value);
    }
}
