<?php declare(strict_types=1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\DomainZoneRecordCollection;

final class DnsTemplate implements DomainObjectInterface
{
    public string $customer;
    public string $name;
    public string $hostMaster;
    public int $refresh;
    public int $retry;
    public int $expire;
    public int $ttl;
    public ?DomainZoneRecordCollection $records = null;

    /* @param DomainZoneRecord[]|null $records */
    private function __construct(
        string $customer,
        string $name,
        string $hostMaster = 'hostmaster@realtimeregister.com',
        int $refresh = 3600,
        int $retry = 3600,
        int $expire = 14 * 24 * 60 * 60,
        int $ttl = 3600,
        ?array $records = null
    )
    {
        $this->customer = $customer;
        $this->name = $name;
        $this->hostMaster = $hostMaster;
        $this->refresh = $refresh;
        $this->retry = $retry;
        $this->expire = $expire;
        $this->ttl = $ttl;
        if ($records !== null) {
            $this->records = DomainZoneRecordCollection::fromArray($records);
        }
    }

    public static function fromArray(array $data): DnsTemplate
    {
        return new DnsTemplate(
            $data['customer'],
            $data['name'],
            $data['hostMaster'],
            $data['refresh'],
            $data['retry'],
            $data['expire'],
            $data['ttl'],
            $data['records'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'customer'   => $this->customer,
            'name'       => $this->name,
            'hostMaster' => $this->hostMaster,
            'refresh'    => $this->refresh,
            'retry'      => $this->retry,
            'expire'     => $this->expire,
            'ttl'        => $this->ttl,
            'records'    => ($this->records !== null ? $this->records->toArray() : null),
        ], function ($x)
        {
            return ! is_null($x);
        });
    }
}