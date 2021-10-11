<?php
declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class ProcessStatusEnum extends AbstractEnum
{
    private const STATUS_NEW = 'NEW';
    private const STATUS_VALIDATED = 'VALIDATED';
    private const STATUS_RUNNING = 'RUNNING';
    private const STATUS_COMPLETED = 'COMPLETED';
    private const STATUS_INVALID = 'INVALID';
    private const STATUS_CANCELLED = 'CANCELLED';
    private const STATUS_FAILED = 'FAILED';
    private const STATUS_IN_DOUBT = 'IN_DOUBT';
    private const STATUS_SCHEDULED = 'SCHEDULED';
    private const STATUS_SUSPENDED = 'SUSPENDED';

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
