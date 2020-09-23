<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class KeyDataProtocolEnum extends AbstractEnum
{
    const PROTOCOL_3 = 3;

    protected static $values = [
        KeyDataProtocolEnum::PROTOCOL_3,
    ];

    /** @param int $value */
    public static function validate($value): void
    {
        KeyDataProtocolEnum::assertValueValid($value);
    }
}
