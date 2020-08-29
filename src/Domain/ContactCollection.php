<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class ContactCollection extends AbstractCollection
{
    /** @var Contact[] */
    public $entities;

    public static function fromArray(array $json): ContactCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Contact
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }

    public static function parseChild(array $json): Contact
    {
        return Contact::fromArray($json);
    }
}
