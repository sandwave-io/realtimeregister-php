<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;
use SandwaveIo\RealtimeRegister\Domain\Enum\DomainZoneServiceEnum;

final class DomainZone implements DomainObjectInterface
{
    public function __construct(
        public int $id,
        public string $customer,
        public DateTime $createdDate,
        public bool $managed,
        public string $service,
        public string $hostMaster,
        public int $refresh,
        public int $retry,
        public int $expire,
        public int $ttl,
        public bool $dnssec,
        public DomainZoneRecordCollection $defaultRecords,
        public ?string $name = null,
        public ?DateTime $updatedDate = null,
        public ?DateTime $deletedDate = null,
        public ?string $template = null,
        public ?string $master = null,
        public ?array $ns = null,
        public ?DomainZoneRecordCollection $records = null,
        public ?KeyDataCollection $keydata = null
    ) {
    }

    public static function fromArray(array $json): self
    {
        DomainZoneServiceEnum::validate($json['service']);

        return new DomainZone(
            $json['id'],
            $json['customer'] ?: null,
            new DateTime($json['createdDate']),
            $json['managed'] ?: null,
            $json['service'] ?: null,
            $json['hostMaster'],
            $json['refresh'],
            $json['retry'],
            $json['expire'],
            $json['ttl'],
            $json['dnssec'],
            DomainZoneRecordCollection::fromArray($json['defaultRecords']),
            $json['name'],
            $json['updatedDate'] ? new DateTime($json['updatedDate']) : null,
            $json['deletedDate'] ? new DateTime($json['deletedDate']) : null,
            $json['template'] ?? null,
            $json['master'] ?? null,
            $json['ns'] ?? null,
            $json['records'] ? DomainZoneRecordCollection::fromArray($json['records']) : null,
            $json['keyData'] ? KeyDataCollection::fromArray($json['keyData']) : null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'customer' => $this->customer ?: null,
            'createdDate' => $this->createdDate->format('Y-m-d\TH:i:s\Z'),
            'name' => $this->name,
            'managed' => $this->managed,
            'service' => $this->service,
            'hostMaster' => $this->hostMaster,
            'refresh' => $this->refresh,
            'retry' => $this->retry,
            'expire' => $this->expire,
            'ttl' => $this->ttl,
            'dnssec' => $this->dnssec,
            'defaultRecords' => $this->defaultRecords->toArray(),
            'updatedDate' => $this->updatedDate?->format('Y-m-d\TH:i:s\Z'),
            'deletedDate' => $this->deletedDate?->format('Y-m-d\TH:i:s\Z'),
            'template' => $this->template,
            'master' => $this->master,
            'ns' => $this->ns,
            'records' => $this->records?->toArray(),
            'keyData' => $this->keydata?->toArray(),
        ], static function ($x) {
            return $x !== null;
        });
    }
}
