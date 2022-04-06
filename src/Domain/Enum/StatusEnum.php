<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class StatusEnum extends AbstractEnum
{
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_EXPIRED = 'EXPIRED';
    const STATUS_REVOKED = 'REVOKED';
    const STATUS_REISSUED = 'REISSUED';
    const STATUS_RENEWED = 'RENEWED';

    protected static array $values = [
        StatusEnum::STATUS_ACTIVE,
        StatusEnum::STATUS_EXPIRED,
        StatusEnum::STATUS_REVOKED,
        StatusEnum::STATUS_REISSUED,
        StatusEnum::STATUS_RENEWED,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        StatusEnum::assertValueValid($value);
    }
}
