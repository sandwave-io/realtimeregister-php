<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class PriceCollection extends AbstractCollection
{
    /** @var Price[] */
    public array $entities;

    public static function fromArray(array $json): PriceCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Price
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): Price
    {
        return Price::fromArray($json);
    }
}
