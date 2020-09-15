<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use InvalidArgumentException;

final class Billable implements DomainObjectInterface
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

    /** @var string */
    public $product;

    /** @var string */
    public $action;

    /** @var int */
    public $quantity;

    private function __construct(
        string $product,
        string $action,
        int $quantity
    ) {
        $this->product = $product;
        $this->action = $action;
        $this->quantity = $quantity;
    }

    public static function fromArray(array $data): Billable
    {
        if (! in_array($data['action'], [
            Billable::ACTION_CREATE,
            Billable::ACTION_REQUEST,
            Billable::ACTION_TRANSFER,
            Billable::ACTION_RENEW,
            Billable::ACTION_RESTORE,
            Billable::ACTION_TRANSFER_RESTORE,
            Billable::ACTION_UPDATE,
            Billable::ACTION_REGISTRANT_CHANGE,
            Billable::ACTION_LOCAL_CONTACT,
            Billable::ACTION_NEGATIVE_MARKUP,
            Billable::ACTION_PRIVACY_PROTECT,
            Billable::ACTION_EXTRA_WILDCARD,
            Billable::ACTION_EXTRA_DOMAIN,
            Billable::ACTION_REGISTRY_LOCK,
        ])) {
            throw new InvalidArgumentException("Provided status not in array: {$data['action']} Billable");
        }

        return new Billable(
            $data['product'],
            $data['action'],
            $data['quantity']
        );
    }

    public function toArray(): array
    {
        return [
            'product' =>$this->product,
            'action' =>$this->action,
            'quantity' =>$this->quantity,
        ];
    }
}
