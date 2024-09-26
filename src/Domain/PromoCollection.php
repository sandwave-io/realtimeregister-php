<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class PromoCollection extends AbstractCollection
{
    /** @var Promo[] */
    public array $entities;

    public static function fromArray(array $json): PromoCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Promo
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): Promo
    {
        return Promo::fromArray($json);
    }
}
