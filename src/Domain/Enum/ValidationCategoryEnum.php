<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class ValidationCategoryEnum extends AbstractEnum
{
    const VALIDATION_CATEGORY_GENERAL = 'General';
    const VALIDATION_CATEGORY_ISI_NU = 'IisNu';
    const VALIDATION_CATEGORY_ISI_SE = 'IisSe';
    const VALIDATION_CATEGORY_NOMINET = 'Nominet';
    const VALIDATION_CATEGORY_DK_HOSTMASTER = 'DkHostmaster';

    protected static $values = [
        ValidationCategoryEnum::VALIDATION_CATEGORY_GENERAL,
        ValidationCategoryEnum::VALIDATION_CATEGORY_ISI_NU,
        ValidationCategoryEnum::VALIDATION_CATEGORY_ISI_SE,
        ValidationCategoryEnum::VALIDATION_CATEGORY_NOMINET,
        ValidationCategoryEnum::VALIDATION_CATEGORY_DK_HOSTMASTER,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        ValidationCategoryEnum::assertValueValid($value);
    }
}
