<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DomainContactCollection extends AbstractCollection
{
    /** @var DomainContact[] */
    public array $entities;

    public static function fromArray(array $json): DomainContactCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?DomainContact
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): DomainContact
    {
        return DomainContact::fromArray($json);
    }
}
