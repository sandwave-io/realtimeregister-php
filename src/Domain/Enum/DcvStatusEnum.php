<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class DcvStatusEnum extends AbstractEnum
{
    const DCV_STATUS_WAITING = 'WAITING';
    const DCV_STATUS_ATTENTION = 'ATTENTION';

    const DCV_STATUS_VALIDATED = 'VALIDATED';

    protected static array $values = [
        self::DCV_STATUS_WAITING,
        self::DCV_STATUS_ATTENTION,
        self::DCV_STATUS_VALIDATED,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
