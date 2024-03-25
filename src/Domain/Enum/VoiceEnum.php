<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class VoiceEnum extends AbstractEnum
{
    const VOICE_WAITING = 'WAITING';
    const VOICE_ATTENTION = 'ATTENTION';

    const VOICE_VALIDATED = 'VALIDATED';

    protected static array $values = [
        self::VOICE_WAITING,
        self::VOICE_ATTENTION,
        self::VOICE_VALIDATED,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
