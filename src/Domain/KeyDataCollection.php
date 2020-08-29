<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class KeyDataCollection extends AbstractCollection
{
    /** @var KeyData[] */
    public $entities;

    public static function fromArray(array $json): KeyDataCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?KeyData
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }

    public static function parseChild(array $json): KeyData
    {
        return KeyData::fromArray($json);
    }
}
