<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class BillableActionEnum extends AbstractEnum
{
    const ACTION_CREATE = 'CREATE';
    const ACTION_REQUEST = 'REQUEST';
    const ACTION_TRANSFER = 'TRANSFER';
    const ACTION_RENEW = 'RENEW';
    const ACTION_RESTORE = 'RESTORE';
    const ACTION_TRANSFER_RESTORE = 'TRANSFER_RESTORE';
    const ACTION_UPDATE = 'UPDATE';
    const ACTION_REGISTRANT_CHANGE = 'REGISTRANT_CHANGE';
    const ACTION_LOCAL_CONTACT = 'LOCAL_CONTACT';
    const ACTION_NEGATIVE_MARKUP = 'NEGATIVE_MARKUP';
    const ACTION_PRIVACY_PROTECT = 'PRIVACY_PROTECT';
    const ACTION_EXTRA_WILDCARD = 'EXTRA_WILDCARD';
    const ACTION_EXTRA_DOMAIN = 'EXTRA_DOMAIN';
    const ACTION_REGISTRY_LOCK = 'REGISTRY_LOCK';

    protected static $values = [
        BillableActionEnum::ACTION_CREATE,
        BillableActionEnum::ACTION_REQUEST,
        BillableActionEnum::ACTION_TRANSFER,
        BillableActionEnum::ACTION_RENEW,
        BillableActionEnum::ACTION_RESTORE,
        BillableActionEnum::ACTION_TRANSFER_RESTORE,
        BillableActionEnum::ACTION_UPDATE,
        BillableActionEnum::ACTION_REGISTRANT_CHANGE,
        BillableActionEnum::ACTION_LOCAL_CONTACT,
        BillableActionEnum::ACTION_NEGATIVE_MARKUP,
        BillableActionEnum::ACTION_PRIVACY_PROTECT,
        BillableActionEnum::ACTION_EXTRA_WILDCARD,
        BillableActionEnum::ACTION_EXTRA_DOMAIN,
        BillableActionEnum::ACTION_REGISTRY_LOCK,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        BillableActionEnum::assertValueValid($value);
    }
}
