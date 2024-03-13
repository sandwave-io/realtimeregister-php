<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

class DomainZoneCollection extends AbstractCollection
{
    /** @var DomainZone[] */
    public array $entities;

    public static function fromArray(array $json): DomainZoneCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?DomainZone
    {
        return $this->entities[$offset] ?? null;
    }

    /**
     * @throws \Exception
     */
    public static function parseChild(array $json): DomainZone
    {
        return DomainZone::fromArray($json);
    }
}
