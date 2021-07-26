<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class LogCollection extends AbstractCollection
{
    /** @var Log[] */
    public array $entities;

    public static function fromArray(array $json): LogCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Log
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): Log
    {
        return Log::fromArray($json);
    }
}
