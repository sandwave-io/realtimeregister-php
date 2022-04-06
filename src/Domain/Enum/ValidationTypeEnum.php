<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class ValidationTypeEnum extends AbstractEnum
{
    const VALIDATION_TYPE_DOMAIN_VALIDATION = 'DOMAIN_VALIDATION';
    const VALIDATION_TYPE_ORGANIZATION_VALIDATION = 'ORGANIZATION_VALIDATION';
    const VALIDATION_TYPE_EXTENDED_VALIDATION = 'EXTENDED_VALIDATION';

    protected static array $values = [
        ValidationTypeEnum::VALIDATION_TYPE_DOMAIN_VALIDATION,
        ValidationTypeEnum::VALIDATION_TYPE_ORGANIZATION_VALIDATION,
        ValidationTypeEnum::VALIDATION_TYPE_EXTENDED_VALIDATION,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        ValidationTypeEnum::assertValueValid($value);
    }
}
