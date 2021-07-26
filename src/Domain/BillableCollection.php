<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class BillableCollection extends AbstractCollection
{
    /** @var Billable[] */
    public array $entities;

    public static function fromArray(array $json): BillableCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Billable
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): Billable
    {
        return Billable::fromArray($json);
    }
}
