<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;

class DomainRegistration implements DomainObjectInterface
{
    public string $domainName;

    public DateTime $expiryDate;

    private function __construct(string $domainName, DateTime $expiryDate)
    {
        $this->domainName = $domainName;
        $this->expiryDate = $expiryDate;
    }

    public static function fromArray(array $json): DomainRegistration
    {
        return new DomainRegistration(
            $json['domainName'],
            new DateTime($json['expiryDate'])
        );
    }

    public function toArray(): array
    {
        return [
            'domainName' => $this->domainName,
            'expiryDate' => $this->expiryDate->format('Y-m-d\TH:i:s\Z'),
        ];
    }
}
