<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class OrganizationEnum extends AbstractEnum
{
    const ORGANIZATION_WAITING = 'WAITING';
    const ORGANIZATION_ATTENTION = 'ATTENTION';

    const ORGANIZATION_VALIDATED = 'VALIDATED';

    protected static array $values = [
        self::ORGANIZATION_WAITING,
        self::ORGANIZATION_ATTENTION,
        self::ORGANIZATION_VALIDATED,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
