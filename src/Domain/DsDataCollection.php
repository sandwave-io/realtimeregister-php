<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DsDataCollection extends AbstractCollection
{
    /** @var DsData[] */
    public $entities;

    public static function fromArray(array $json): DsDataCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?DsData
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }

    public static function parseChild(array $json): DsData
    {
        return DsData::fromArray($json);
    }
}
