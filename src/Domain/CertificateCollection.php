<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class CertificateCollection extends AbstractCollection
{
    /** @var Certificate[] */
    public array $entities;

    public static function fromArray(array $json): CertificateCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?Certificate
    {
        return $this->entities[$offset] ?? null;
    }

    public static function parseChild(array $json): Certificate
    {
        return Certificate::fromArray($json);
    }
}
