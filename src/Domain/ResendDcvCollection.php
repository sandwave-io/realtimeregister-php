<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

class ResendDcvCollection extends AbstractCollection
{
    /** @var ResendDcv[] */
    public array $entities;

    public static function fromArray(array $json): ResendDcvCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?ResendDcv
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): ResendDcv
    {
        return ResendDcv::fromArray($json);
    }

    public function toArray(): array
    {
        return [
            "dcv" => parent::toArray()
        ];
    }
}
