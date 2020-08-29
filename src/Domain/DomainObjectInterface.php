<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

interface DomainObjectInterface
{
    public function toArray(): array;

    /* @phpstan-ignore-next-line */
    public static function fromArray(array $json);
}
