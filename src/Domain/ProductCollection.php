<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class ProductCollection extends AbstractCollection
{
    /** @var Product[] */
    public array $entities;

    public static function fromArray(array $json): ProductCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Product
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): Product
    {
        return Product::fromArray($json);
    }
}
