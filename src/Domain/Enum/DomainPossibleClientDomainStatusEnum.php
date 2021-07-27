<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class DomainPossibleClientDomainStatusEnum extends AbstractEnum
{
    const STATUS_CLIENT_HOLD = 'CLIENT_HOLD';
    const STATUS_CLIENT_DELETE_PROHIBITED = 'CLIENT_DELETE_PROHIBITED';
    const STATUS_CLIENT_UPDATE_PROHIBITED = 'CLIENT_UPDATE_PROHIBITED';
    const STATUS_CLIENT_RENEW_PROHIBITED = 'CLIENT_RENEW_PROHIBITED';
    const STATUS_CLIENT_TRANSFER_PROHIBITED = 'CLIENT_TRANSFER_PROHIBITED';
    const STATUS_IRTPC_TRANSFER_PROHIBITED = 'IRTPC_TRANSFER_PROHIBITED';

    protected static array $values = [
        DomainPossibleClientDomainStatusEnum::STATUS_CLIENT_HOLD,
        DomainPossibleClientDomainStatusEnum::STATUS_CLIENT_DELETE_PROHIBITED,
        DomainPossibleClientDomainStatusEnum::STATUS_CLIENT_UPDATE_PROHIBITED,
        DomainPossibleClientDomainStatusEnum::STATUS_CLIENT_RENEW_PROHIBITED,
        DomainPossibleClientDomainStatusEnum::STATUS_CLIENT_TRANSFER_PROHIBITED,
        DomainPossibleClientDomainStatusEnum::STATUS_IRTPC_TRANSFER_PROHIBITED,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        DomainPossibleClientDomainStatusEnum::assertValueValid($value);
    }
}
