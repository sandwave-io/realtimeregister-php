<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\DomainContactRoleEnum;

final class DomainContact implements DomainObjectInterface
{
    public string $role;

    public string $handle;

    private function __construct(string $role, string $handle)
    {
        $this->role = $role;
        $this->handle = $handle;
    }

    public static function fromArray(array $json): DomainContact
    {
        DomainContactRoleEnum::validate($json['role']);

        return new DomainContact($json['role'], $json['handle']);
    }

    public function toArray(): array
    {
        return [
            'role' => $this->role,
            'handle' => $this->handle,
        ];
    }
}
