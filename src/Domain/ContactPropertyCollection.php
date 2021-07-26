<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class ContactPropertyCollection extends AbstractCollection
{
    /** @var ContactProperty[] */
    public array $entities;

    public static function fromArray(array $json): ContactPropertyCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?ContactProperty
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): ContactProperty
    {
        return ContactProperty::fromArray($json);
    }
}
