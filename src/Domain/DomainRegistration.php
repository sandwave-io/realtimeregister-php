<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Carbon\Carbon;

class DomainRegistration implements DomainObjectInterface
{
    /** @var string */
    public $domainName;

    /** @var Carbon */
    public $expiryDate;

    private function __construct(string $domainName, Carbon $expiryDate)
    {
        $this->domainName = $domainName;
        $this->expiryDate = $expiryDate;
    }

    public static function fromArray(array $json): DomainRegistration
    {
        return new DomainRegistration(
            $json['domainName'],
            new Carbon($json['expiryDate'])
        );
    }

    public function toArray(): array
    {
        return [
            'domainName' => $this->domainName,
            'expiryDate' => $this->expiryDate->toDateTimeString(),
        ];
    }
}
