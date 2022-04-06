<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class DcvTypeEnum extends AbstractEnum
{
    const LOCALE_EMAIL = 'EMAIL';
    const LOCALE_FILE = 'FILE';
    const LOCALE_DNS = 'DNS';

    protected static array $values = [
        DcvTypeEnum::LOCALE_EMAIL,
        DcvTypeEnum::LOCALE_FILE,
        DcvTypeEnum::LOCALE_DNS,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        DcvTypeEnum::assertValueValid($value);
    }
}
