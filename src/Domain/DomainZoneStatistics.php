<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

class DomainZoneStatistics implements DomainObjectInterface
{
    public function __construct(public DomainZoneQueriesCollection $queries)
    {
    }

    public function toArray(): array
    {
        return array_filter([
            'queries' => $this->queries->toArray(),
        ], static function ($x) {
            return $x !== null;
        });
    }

    public static function fromArray(array $json): DomainZoneStatistics
    {
        return new DomainZoneStatistics(
            DomainZoneQueriesCollection::fromArray(['entities' => $json['queries']])
        );
    }
}
