<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class DomainTransferTypeEnum extends AbstractEnum
{
    const TYPE_IN = 'IN';
    const TYPE_OUT = 'OUT';

    protected static array $values = [
        DomainTransferTypeEnum::TYPE_IN,
        DomainTransferTypeEnum::TYPE_OUT,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        DomainTransferTypeEnum::assertValueValid($value);
    }
}
