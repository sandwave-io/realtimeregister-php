<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

class DomainZoneUpdate
{
    private function __construct(private int $id)
    {
    }

    public static function fromArray(array $json): DomainZoneUpdate
    {
        return new DomainZoneUpdate(
            $json['id'],
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
