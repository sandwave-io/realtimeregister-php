<?php

declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class ResumeTypeEnum extends AbstractEnum
{
    const TYPE_PROVIDER = 'PROVIDER';
    const TYPE_TIMER = 'TIMER';
    const TYPE_MANUAL = 'MANUAL';
    const TYPE_INTERNAL = 'INTERNAL';
    const TYPE_RESEND = 'RESEND';
    const TYPE_CANCEL = 'CANCEL';

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
