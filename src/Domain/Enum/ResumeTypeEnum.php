<?php

declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class ResumeTypeEnum extends AbstractEnum
{
    private const TYPE_PROVIDER = 'PROVIDER';
    private const TYPE_TIMER = 'TIMER';
    private const TYPE_MANUAL = 'MANUAL';
    private const TYPE_INTERNAL = 'INTERNAL';
    private const TYPE_RESEND = 'RESEND';
    private const TYPE_CANCEL = 'CANCEL';

    protected static array $values = [
        ResumeTypeEnum::TYPE_PROVIDER,
        ResumeTypeEnum::TYPE_TIMER,
        ResumeTypeEnum::TYPE_MANUAL,
        ResumeTypeEnum::TYPE_INTERNAL,
        ResumeTypeEnum::TYPE_RESEND,
        ResumeTypeEnum::TYPE_CANCEL,
    ];

    /**
     * @param string $value
     */
    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
