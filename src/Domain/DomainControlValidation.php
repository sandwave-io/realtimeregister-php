<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\DcvDnsTypeRecordEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\DcvStatusEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\DcvTypeEnum;

class DomainControlValidation implements DomainObjectInterface
{
    public function __construct(
        public readonly string $commonName,
        public readonly string $type,
        public readonly string $status,
        public readonly ?string $email,
        public readonly ?string $dnsRecord,
        public readonly ?string $dnsType,
        public readonly ?string $dnsContents,
        public readonly ?string $fileLocation,
        public readonly ?string $fileContents
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'commonName' => $this->commonName,
            'type' => $this->type,
            'status' => $this->status,
            'email' => $this->email,
            'dnsRecord' => $this->dnsRecord,
            'dnsType' => $this->dnsType,
            'dnsContents' => $this->dnsContents,
            'fileLocation' => $this->fileLocation,
            'fileContents' => $this->fileContents,
        ], function ($x) {
            return ! is_null($x);
        });
    }

    public static function fromArray(array $json): DomainControlValidation
    {
        DcvTypeEnum::validate($json['type']);
        DcvStatusEnum::validate($json['status']);
        if (array_key_exists('dnsType', $json)) {
            DcvDnsTypeRecordEnum::validate($json['dnsType']);
        }

        return new DomainControlValidation(
            $json['commonName'],
            $json['type'],
            $json['status'],
            $json['email'] ?? null,
            $json['dnsRecord'] ?? null,
            $json['dnsType'] ?? null,
            $json['dnsContents'] ?? null,
            $json['fileLocation'] ?? null,
            $json['fileContents'] ?? null,
        );
    }
}
