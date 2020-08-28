<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Webmozart\Assert\Assert;

final class DomainContact implements DomainObjectInterface
{
    const ROLE_ADMIN = 'ADMIN';
    const ROLE_BILLING = 'BILLING';
    const ROLE_TECH = 'TECH';

    /** @var string */
    public $role;

    /** @var string */
    public $handle;

    private function __construct(string $role, string $handle)
    {
        $this->role = $role;
        $this->handle = $handle;
    }

    public static function fromArray(array $json): DomainContact
    {
        Assert::inArray($json['role'], [
            DomainContact::ROLE_ADMIN,
            DomainContact::ROLE_BILLING,
            DomainContact::ROLE_TECH,
        ]);
        return new DomainContact($json['role'], $json['handle']);
    }

    public function toArray(): array
    {
        return [
            'role' =>$this->role,
            'handle' =>$this->handle,
        ];
    }
}
