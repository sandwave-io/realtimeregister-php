<?php declare(strict_types=1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DnsTemplateCollection extends AbstractCollection
{
    /** @var DnsTemplate[] */
    public array $entities;

    public static function fromArray(array $data): DnsTemplateCollection
    {
        return parent::fromArray($data);
    }

    public function offsetGet($offset): ?DnsTemplate
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $data): DnsTemplate
    {
        return DnsTemplate::fromArray($data);
    }
}