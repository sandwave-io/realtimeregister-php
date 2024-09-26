<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\IpVersion;

class DnsHostAddress implements DomainObjectInterface
{
    public IpVersion $ipVersion;

    public string $address;

    private function __construct(IpVersion $ipVersion, string $address)
    {
        $this->ipVersion = $ipVersion;
        $this->address = $address;
    }

    public function toArray(): array
    {
        return array_filter([
            'ipVersion' => $this->ipVersion->value,
            'address' => $this->address,
        ], function ($x) {
            return $x !== null;
        });
    }

    public static function fromArray(array $json): DnsHostAddress
    {
        return new DnsHostAddress(
            ipVersion: IpVersion::from($json['ipVersion']),
            address: $json['address'],
        );
    }
}
