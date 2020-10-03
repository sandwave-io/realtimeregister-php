<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class ProviderCollection extends AbstractCollection
{
    /** @var Provider[] */
    public $entities;

    public static function fromArray(array $json): ProviderCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Provider
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }

    public static function parseChild(array $json): Provider
    {
        return Provider::fromArray($json);
    }
}
