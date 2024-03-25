<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

class CertificateInfoProcess implements DomainObjectInterface
{
    public function __construct(
        public String $commonName,
        public bool $requiresAttention,
        public ?int $certificateId,
        public ?CertificateValidation $validations
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'commonName' => $this->commonName,
            'requiresAttention' => $this->requiresAttention,
            'certificateId' => $this->certificateId,
            'validations' => $this->validations ? $this->validations->toArray() : null,
        ], function ($x) {
            return ! is_null($x);
        });
    }

    public static function fromArray(array $json): CertificateInfoProcess
    {
        return new CertificateInfoProcess(
            $json['commonName'],
            $json['requiresAttention'],
            $json['certificateId'],
            CertificateValidation::fromArray($json['validations'])
        );
    }
}
