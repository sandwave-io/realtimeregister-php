<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;
use SandwaveIo\RealtimeRegister\Domain\Enum\CertificateTypeEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\PublicKeyAlgorithmEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\StatusEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\ValidationTypeEnum;

final class Certificate implements DomainObjectInterface
{
    public int $id;
    public string $product;
    public string $validationType;
    public string $certificateType;
    public string $domainName;
    public ?string $organization;
    public ?string $department;
    /** @var string[] */
    public ?array $addressLine;
    public ?string $city;
    public ?string $state;
    public ?string $postalCode;
    public ?string $country;
    public ?string $coc;
    public ?string $providerId;
    public DateTime $startDate;
    public DateTime $expiryDate;
    /** @var string[] */
    public ?array $san;
    public string $status;
    public ?string $publicKeyAlgorithm;
    public ?int $publicKeySize;
    public ?string $csr;
    public ?string $certificate;
    public ?string $fingerprint;

    private function __construct(
        int $id,
        string $product,
        string $validationType,
        string $certificateType,
        string $domainName,
        ?string $organization,
        ?string $department,
        ?array $addressLine,
        ?string $city,
        ?string $state,
        ?string $postalCode,
        ?string $country,
        ?string $coc,
        ?string $providerId,
        DateTime $startDate,
        DateTime $expiryDate,
        ?array $san,
        string $status,
        ?string $publicKeyAlgorithm,
        ?int $publicKeySize,
        ?string $csr,
        ?string $certificate,
        ?string $fingerprint
    ) {
        $this->id = $id;
        $this->product = $product;
        $this->validationType = $validationType;
        $this->certificateType = $certificateType;
        $this->domainName = $domainName;
        $this->organization = $organization;
        $this->department = $department;
        $this->addressLine = $addressLine;
        $this->city = $city;
        $this->state = $state;
        $this->postalCode = $postalCode;
        $this->country = $country;
        $this->coc = $coc;
        $this->providerId = $providerId;
        $this->startDate = $startDate;
        $this->expiryDate = $expiryDate;
        $this->san = $san;
        $this->status = $status;
        $this->publicKeyAlgorithm = $publicKeyAlgorithm;
        $this->publicKeySize = $publicKeySize;
        $this->csr = $csr;
        $this->certificate = $certificate;
        $this->fingerprint = $fingerprint;
    }

    public static function fromArray(array $json): Certificate
    {
        CertificateTypeEnum::validate($json['certificateType']);
        PublicKeyAlgorithmEnum::validate($json['publicKeyAlgorithm']);
        StatusEnum::validate($json['status']);
        ValidationTypeEnum::validate($json['validationType']);

        return new Certificate(
            $json['id'],
            $json['product'],
            $json['validationType'],
            $json['certificateType'],
            $json['domainName'],
            $json['organization'] ?? null,
            $json['department'] ?? null,
            $json['addressLine'] ?? null,
            $json['city'] ?? null,
            $json['state'] ?? null,
            $json['postalCode'] ?? null,
            $json['country'] ?? null,
            $json['coc'] ?? null,
            $json['providerId'] ?? null,
            new DateTime($json['startDate']),
            new DateTime($json['expiryDate']),
            $json['san'] ?? null,
            $json['status'],
            $json['publicKeyAlgorithm'] ?? null,
            $json['publicKeySize'] ?? null,
            $json['csr'] ?? null,
            $json['certificate'] ?? null,
            $json['fingerprint'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'product' => $this->product,
            'validationType' => $this->validationType,
            'certificateType' => $this->certificateType,
            'domainName' => $this->domainName,
            'organization' => $this->organization,
            'department' => $this->department,
            'addressLine' => $this->addressLine,
            'city' => $this->city,
            'state' => $this->state,
            'postalCode' => $this->postalCode,
            'country' => $this->country,
            'coc' => $this->coc,
            'providerId' => $this->providerId,
            'startDate' => $this->startDate->format('Y-m-d\TH:i:s\Z'),
            'expiryDate' => $this->expiryDate->format('Y-m-d\TH:i:s\Z'),
            'san' => $this->san,
            'status' => $this->status,
            'publicKeyAlgorithm' => $this->publicKeyAlgorithm,
            'publicKeySize' => $this->publicKeySize,
            'csr' => $this->csr,
            'certificate' => $this->certificate,
            'fingerprint' => $this->fingerprint,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
