<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DnsZoneCollection extends AbstractCollection
{
    /** @var DnsZone[] */
    public array $entities;

    public static function fromArray(array $json): self
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?DnsZone
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): DnsZone
    {
        return DnsZone::fromArray($json);
    }
}
