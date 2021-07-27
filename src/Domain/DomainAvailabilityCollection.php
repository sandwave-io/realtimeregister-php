<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DomainAvailabilityCollection extends AbstractCollection
{
    /** @var DomainAvailability[] */
    public array $entities;

    public static function fromArray(array $json): DomainAvailabilityCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?DomainAvailability
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): DomainAvailability
    {
        return DomainAvailability::fromArray($json);
    }
}
