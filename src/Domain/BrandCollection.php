<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class BrandCollection extends AbstractCollection
{
    /** @var Brand[] */
    public $entities;

    public static function fromArray(array $json): BrandCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Brand
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }

    public static function parseChild(array $json): Brand
    {
        return Brand::fromArray($json);
    }
}
