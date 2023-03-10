<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DomainZone implements DomainObjectInterface
{
    public ?string $template;

    public string $hostMaster;

    public int $refresh;

    public int $retry;

    public int $expire;

    public int $ttl;

    public DomainZoneRecordCollection $defaultRecords;

    public ?DomainZoneRecordCollection $records = null;

    private function __construct(
        ?string $template,
        string $hostMaster,
        int $refresh,
        int $retry,
        int $expire,
        int $ttl,
        array $defaultRecords,
        ?array $records
    ) {
        $this->template = $template;
        $this->hostMaster = $hostMaster;
        $this->refresh = $refresh;
        $this->retry = $retry;
        $this->expire = $expire;
        $this->ttl = $ttl;
        $this->defaultRecords = DomainZoneRecordCollection::fromArray($defaultRecords);
        if ($records !== null) {
            $this->records = DomainZoneRecordCollection::fromArray($records);
        }
    }

    public static function fromArray(array $json): DomainZone
    {
        return new DomainZone(
            $json['template'] ?? null,
            $json['hostMaster'],
            $json['refresh'],
            $json['retry'],
            $json['expire'],
            $json['ttl'],
            $json['defaultRecords'],
            $json['records'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'template' => $this->template,
            'hostMaster' => $this->hostMaster,
            'refresh' => $this->refresh,
            'retry' => $this->retry,
            'expire' => $this->expire,
            'ttl' => $this->ttl,
            'defaultRecords' => $this->defaultRecords->toArray(),
            'records' => ($this->records !== null ? $this->records->toArray() : null),
        ], static function ($x) {
            return $x !== null;
        });
    }
}
