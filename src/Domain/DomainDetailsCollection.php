<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DomainDetailsCollection extends AbstractCollection
{
    /** @var DomainDetails[] */
    public $entities;

    public static function fromArray(array $json): DomainDetailsCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?DomainDetails
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }

    public static function parseChild(array $json): DomainDetails
    {
        return DomainDetails::fromArray($json);
    }
}
