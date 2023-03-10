<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\DomainZoneRecordTypeEnum;

final class DomainZoneRecord implements DomainObjectInterface
{
    public string $name;

    public string $type;

    public string $content;

    public int $ttl;

    public ?int $prio;

    private function __construct(
        string $name,
        string $type,
        string $content,
        int $ttl,
        ?int $prio
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->content = $content;
        $this->ttl = $ttl;
        $this->prio = $prio;
    }

    public static function fromArray(array $json): DomainZoneRecord
    {
        DomainZoneRecordTypeEnum::validate($json['type']);

        return new DomainZoneRecord(
            $json['name'],
            $json['type'],
            $json['content'],
            $json['ttl'],
            $json['prio'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'type' => $this->type,
            'content' => $this->content,
            'ttl' => $this->ttl,
            'prio' => $this->prio,
        ], static function ($x) {
            return $x !== null;
        });
    }
}
