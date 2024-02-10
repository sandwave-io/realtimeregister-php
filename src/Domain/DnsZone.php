<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTimeImmutable;
use SandwaveIo\RealtimeRegister\Domain\Enum\ZoneServiceEnum;

final class DnsZone implements DomainObjectInterface
{
    private function __construct(
        public int $id,
        public string $name,
        public string $customer,
        public DateTimeImmutable $createdDate,
        public ?DateTimeImmutable $updatedDate,
        public ?DateTimeImmutable $deletionDate,
        public bool $managed,
        public ZoneServiceEnum $service,
        public ?string $template,
        public ?string $master,
        public ?array $ns,
        public DomainZoneRecordCollection $defaultRecords,
        public string $hostMaster = 'hostmaster@realtimeregister.com',
        public int $refresh = 3600,
        public int $retry = 3600,
        public int $expire = 14 * 24 * 60 * 60,
        public int $ttl = 3600,
        public bool $dnssec = false,
        public ?DomainZoneRecordCollection $records = null,
        public ?KeyDataCollection $keyData = null,
    ) {
    }

    public static function fromArray(array $json): self
    {
        return new DnsZone(
            $json['id'],
            $json['name'] ?? null,
            $json['customer'],
            new DateTimeImmutable($json['createdDate']),
            isset($json['updatedDate']) ? new DateTimeImmutable($json['updatedDate']) : null,
            isset($json['deletionDate']) ? new DateTimeImmutable($json['deletionDate']) : null,
            $json['managed'],
            ZoneServiceEnum::from($json['service']),
            $json['template'] ?? null,
            $json['master'] ?? null,
            $json['ns'] ?? null,
            DomainZoneRecordCollection::fromArray($json['defaultRecords']),
            $json['hostMaster'],
            $json['refresh'],
            $json['retry'],
            $json['expire'],
            $json['ttl'],
            $json['dnssec'],
            isset($json['records']) ? DomainZoneRecordCollection::fromArray($json['records']) : null,
            isset($json['keyData']) ? KeyDataCollection::fromArray($json['keyData']) : null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'customer' => $this->customer,
            'name' => $this->name,
            'createdDate' => $this->createdDate->format('Y-m-d\TH:i:s\Z'),
            'updatedDate' => $this->updatedDate?->format('Y-m-d\TH:i:s\Z'),
            'deletionDate' => $this->deletionDate?->format('Y-m-d\TH:i:s\Z'),
            'service' => $this->service->value,
            'dnssec' => $this->dnssec,
            'managed' => $this->managed,
            'template' => $this->template,
            'master' => $this->master,
            'ns' => $this->ns,
            'hostMaster' => $this->hostMaster,
            'refresh' => $this->refresh,
            'retry' => $this->retry,
            'expire' => $this->expire,
            'ttl' => $this->ttl,
            'defaultRecords' => $this->defaultRecords->toArray(),
            'records' => $this->records?->toArray(),
            'keyData' => $this->keyData?->toArray(),
        ], function ($x) {
            return $x !== null;
        });
    }
}
