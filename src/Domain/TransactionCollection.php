<?php

declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Exception;

class TransactionCollection extends AbstractCollection
{
    /** @var Transaction[] */
    public array $entities;

    public static function fromArray(array $json): TransactionCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Transaction
    {
        return $this->entities[$offset] ?? null;
    }

    /**
     * @throws Exception
     */
    public static function parseChild(array $json): Transaction
    {
        return Transaction::fromArray($json);
    }
}
