<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;

class DomainRegistration implements DomainObjectInterface
{
    /** @var string */
    public $domainName;

    /** @var DateTime */
    public $expiryDate;

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
            'expiryDate' => $this->expiryDate->format('Y-m-d H:i:s'),
        ];
    }
}
