<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;

class DnsHost implements DomainObjectInterface
{
    public string $hostName;

    public Datetime $createdDate;

    public ?Datetime $updatedDate;

    public ?array $addresses;

    private function __construct(
        string $hostname,
        DateTime $createdDate,
        ?DateTime $updatedDate,
        ?array $addresses
    ) {
        $this->hostName = $hostname;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
        $this->addresses = $addresses;
    }

    public function toArray(): array
    {
        return array_filter([
            'hostName' => $this->hostName,
            'createdDate' => $this->createdDate->format('Y-m-d\TH:i:s\Z'),
            'updatedDate' => $this->updatedDate?->format('Y-m-d\TH:i:s\Z'),
            'addresses' => $this->addresses,
        ], function ($x) {
            return ! is_null($x);
        });
    }

    public static function fromArray(array $json): DnsHost
    {
        $updatedDate = isset($json['updatedDate']) ? new DateTime($json['updatedDate']) : null;
        return new DnsHost(
            $json['hostName'],
            new DateTime($json['createdDate']),
            $updatedDate,
            $json['addresses']??null
        );
    }
}
