<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class ContactCollection extends AbstractCollection
{
    /** @var Contact[] */
    public array $entities;

    public static function fromArray(array $json): ContactCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Contact
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): Contact
    {
        return Contact::fromArray($json);
    }
}
