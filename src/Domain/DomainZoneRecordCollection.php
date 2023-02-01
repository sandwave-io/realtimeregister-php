<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DomainZoneRecordCollection extends AbstractCollection
{
    /** @var DomainZoneRecord[] */
    public array $entities;

    public static function fromArray(array $json): DomainZoneRecordCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?DomainZoneRecord
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): DomainZoneRecord
    {
        return DomainZoneRecord::fromArray($json);
    }
}
