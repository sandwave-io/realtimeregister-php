<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class AccountCollection extends AbstractCollection
{
    /** @var Account[] */
    public array $entities;

    public static function fromArray(array $json): AccountCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Account
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): Account
    {
        return Account::fromArray($json);
    }
}
