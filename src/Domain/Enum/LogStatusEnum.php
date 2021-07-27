<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class LogStatusEnum extends AbstractEnum
{
    const STATUS_PENDINGWHOIS = 'pendingwhois';
    const STATUS_PENDINGFOA = 'pendingfoa';
    const STATUS_PENDINGVALIDATION = 'pendingvalidation';
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_REJECTED = 'rejected';
    const STATUS_FAILED = 'failed';
    const STATUS_COMPLETED = 'completed';

    protected static array $values = [
        LogStatusEnum::STATUS_PENDINGWHOIS,
        LogStatusEnum::STATUS_PENDINGFOA,
        LogStatusEnum::STATUS_PENDINGVALIDATION,
        LogStatusEnum::STATUS_PENDING,
        LogStatusEnum::STATUS_APPROVED,
        LogStatusEnum::STATUS_CANCELLED,
        LogStatusEnum::STATUS_REJECTED,
        LogStatusEnum::STATUS_FAILED,
        LogStatusEnum::STATUS_COMPLETED,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        LogStatusEnum::assertValueValid($value);
    }
}
