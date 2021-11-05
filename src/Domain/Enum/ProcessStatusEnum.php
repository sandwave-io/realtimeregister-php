<?php
declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class ProcessStatusEnum extends AbstractEnum
{
    const STATUS_NEW = 'NEW';
    const STATUS_VALIDATED = 'VALIDATED';
    const STATUS_RUNNING = 'RUNNING';
    const STATUS_COMPLETED = 'COMPLETED';
    const STATUS_INVALID = 'INVALID';
    const STATUS_CANCELLED = 'CANCELLED';
    const STATUS_FAILED = 'FAILED';
    const STATUS_IN_DOUBT = 'IN_DOUBT';
    const STATUS_SCHEDULED = 'SCHEDULED';
    const STATUS_SUSPENDED = 'SUSPENDED';

    protected static array $values = [
      ProcessStatusEnum::STATUS_NEW,
      ProcessStatusEnum::STATUS_VALIDATED,
      ProcessStatusEnum::STATUS_RUNNING,
      ProcessStatusEnum::STATUS_COMPLETED,
      ProcessStatusEnum::STATUS_INVALID,
      ProcessStatusEnum::STATUS_CANCELLED,
      ProcessStatusEnum::STATUS_FAILED,
      ProcessStatusEnum::STATUS_IN_DOUBT,
      ProcessStatusEnum::STATUS_SCHEDULED,
      ProcessStatusEnum::STATUS_SUSPENDED,
    ];

    /**
     * @param string $value
     */
    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
