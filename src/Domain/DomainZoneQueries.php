<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

class DomainZoneQueries implements DomainObjectInterface
{
    public function __construct(public \DateTime $date, public int $qcount, public int $nxcount)
    {
    }

    public function toArray(): array
    {
        return [
            'date' => $this->date->format('Y-m-d'),
            'qcount' => $this->qcount,
            'nxcount' => $this->nxcount,
        ];
    }

    public static function fromArray(array $json): DomainZoneQueries
    {
        return new DomainZoneQueries(
            new \DateTime($json['date']),
            $json['qcount'],
            $json['nxcount']
        );
    }
}
