<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

class DnsHostCollection extends AbstractCollection
{
    /** @var DnsHost[] */
    public array $entities;

    public static function fromArray(array $json): DnsHostCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?DnsHost
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): DnsHost
    {
        return DnsHost::fromArray($json);
    }
}
