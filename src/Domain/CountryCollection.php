<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class CountryCollection extends AbstractCollection
{
    /** @var Country[] */
    public array $entities;

    public static function fromArray(array $json): CountryCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Country
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): Country
    {
        return Country::fromArray($json);
    }
}
