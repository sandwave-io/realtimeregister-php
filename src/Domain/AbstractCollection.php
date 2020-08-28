<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;

abstract class AbstractCollection implements ArrayAccess, IteratorAggregate, Countable
{
    /** @var array<DomainObjectInterface> */
    public $entities;

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->entities);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->entities[$offset]);
    }

    abstract public function offsetGet($offset);

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->entities[] = $value;
        } else {
            $this->entities[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->entities[$offset]);
    }

    public function count(): int
    {
        return count($this->entities);
    }


    public function toArray(): array
    {
        return array_map(function (DomainObjectInterface $object) {
            return $object->toArray();
        }, $this->entities);
    }
}
