<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

class DnsHostAddressCollection extends AbstractCollection
{
    /** @var DnsHostAddress[] */
    public array $entities;

    public static function fromArray(array $json): DnsHostAddressCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?DnsHostAddress
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): DnsHostAddress
    {
        return DnsHostAddress::fromArray($json);
    }
}
