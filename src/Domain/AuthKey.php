<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;

class AuthKey implements DomainObjectInterface
{
    public function __construct(
        public readonly string $authKey,
        public readonly DateTime $validity
    ) {
    }

    public function toArray(): array
    {
        return [
            'authKey' => $this->authKey,
            'validity' => $this->validity->format('Y-m-d\TH:i:s\Z'),
        ];
    }

    public static function fromArray(array $json): AuthKey
    {
        return new AuthKey($json['authKey'], new DateTime($json['validity']));
    }
}
