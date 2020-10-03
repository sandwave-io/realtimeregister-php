<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DowntimeCollection extends AbstractCollection
{
    /** @var Downtime[] */
    public $entities;

    public static function fromArray(array $json): DowntimeCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Downtime
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }

    public static function parseChild(array $json): Downtime
    {
        return Downtime::fromArray($json);
    }
}
