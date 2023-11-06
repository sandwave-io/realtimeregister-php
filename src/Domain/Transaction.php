<?php

declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use Webmozart\Assert\Assert;

final class Transaction implements DomainObjectInterface
{
    private function __construct(
        public int $id,
        public string $customer,
        public DateTimeInterface $date,
        public int $amount,
        public string $currency,
        public int $processId,
        public string $processType,
        public string $processIdentifier,
        public string $processAction,
        /** @var array<string, int>|null */
        public ?array $chargesPerAccount,
        public ?BillableCollection $billables
    ) {
    }

    public function toArray(): array
    {
        return array_filter(
            [
                'id' => $this->id,
                'customer' => $this->customer,
                'date' => $this->date->format('Y-m-d\TH:i:s\Z'),
                'amount' => $this->amount,
                'currency' => $this->currency,
                'processId' => $this->processId,
                'processType' => $this->processType,
                'processIdentifier' => $this->processIdentifier,
                'processAction' => $this->processAction,
                'chargesPerAccount' => $this->chargesPerAccount,
                'billables' => $this->billables?->toArray(),
            ],
            static function ($x) {
                return ! is_null($x);
            }
        );
    }

    /**
     * @throws Exception
     */
    public static function fromArray(array $json): Transaction
    {
        if (array_key_exists('chargesPerAccount', $json)) {
            Assert::isArray($json['chargesPerAccount']);
        }

        return new Transaction(
            id: $json['id'],
            customer: $json['customer'],
            date: new DateTimeImmutable($json['date']),
            amount: $json['amount'],
            currency: $json['currency'],
            processId: $json['processId'],
            processType: $json['processType'],
            processIdentifier: $json['processIdentifier'],
            processAction: $json['processAction'],
            chargesPerAccount: $json['chargesPerAccount'] ?? null,
            billables: isset($json['billables']) ? BillableCollection::fromArray($json['billables']) : null
        );
    }
}
