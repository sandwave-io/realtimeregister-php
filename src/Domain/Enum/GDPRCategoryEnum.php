<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class GDPRCategoryEnum extends AbstractEnum
{
    const CATEGORY_EU_BASED = 'EU_BASED';
    const CATEGORY_ADEQUACY = 'ADEQUACY';
    const CATEGORY_DATA_EXPORT = 'DATA_EXPORT';
    const CATEGORY_UNKNOWN = 'UNKNOWN';

    protected static $values = [
        GDPRCategoryEnum::CATEGORY_EU_BASED,
        GDPRCategoryEnum::CATEGORY_ADEQUACY,
        GDPRCategoryEnum::CATEGORY_DATA_EXPORT,
        GDPRCategoryEnum::CATEGORY_UNKNOWN,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        GDPRCategoryEnum::assertValueValid($value);
    }
}
