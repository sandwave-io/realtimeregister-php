<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use Webmozart\Assert\Assert;

abstract class AbstractCollection implements ArrayAccess, IteratorAggregate, Countable
{
    /** @var array<DomainObjectInterface> */
    public $entities;

    /** @var Pagination */
    public $pagination;

    /**
     * @param Billable[] $entities
     * @param Pagination $pagination
     */
    private function __construct(array $entities, Pagination $pagination)
    {
        $this->entities = $entities;
        $this->pagination = $pagination;
    }

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

    /* @phpstan-ignore-next-line */
    public static function fromArray(array $json)
    {
        Assert::keyExists($json, 'entities');
        Assert::isArray($json['entities']);
        if ($json['pagination']) {
            $pagination = Pagination::fromArray($json['pagination']);
        } else {
            $pagination = Pagination::fromArray([
                'limit' => count($json['entities']),
                'offset' => 0,
                'total' => count($json['entities']),
            ]);
        }
        $entities   = array_map(function ($child) {
            return static::parseChild($child);
        }, $json['entities']);

        /* @phpstan-ignore-next-line */
        return new static($entities, $pagination);
    }

    /* @phpstan-ignore-next-line */
    abstract public static function parseChild(array $json);

    public function toArray(): array
    {
        return array_filter(array_map(function (DomainObjectInterface $object) {
            return $object->toArray();
        }, $this->entities));
    }
}
