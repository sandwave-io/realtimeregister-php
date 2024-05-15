<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

class DomainControlValidationCollection extends AbstractCollection
{
    /** @var DomainControlValidation[] */
    public array $entities;

    public static function fromArray(array $json): DomainControlValidationCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?DomainControlValidation
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): DomainControlValidation
    {
        return DomainControlValidation::fromArray($json);
    }
}
