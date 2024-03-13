<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

class DomainZoneQueriesCollection extends AbstractCollection
{
    /** @var DomainZoneStatistics[] */
    public array $entities;

    public static function fromArray(array $json): DomainZoneQueriesCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?DomainZoneStatistics
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): DomainZoneQueries
    {
        return DomainZoneQueries::fromArray($json);
    }
}
