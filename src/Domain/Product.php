<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\CertificateTypeEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\FeatureEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\ValidationTypeEnum;

final class Product implements DomainObjectInterface
{
    public string $product;
    public string $brand;
    public string $name;
    public string $validationType;
    public string $certificateType;
    /** @var string[] */
    public array $features;
    /** @var int[] */
    public array $periods;
    public int $warranty;
    public string $issueTime;
    public int $renewalWindow;
    public int $includedDomains;
    public int $maxDomains;
    /** @var string[] */
    public array $requiredFields;
    /** @var string[] */
    public array $optionalFields;

    private function __construct(
        string $product,
        string $brand,
        string $name,
        string $validationType,
        string $certificateType,
        array $features,
        array $periods,
        int $warranty,
        string $issueTime,
        int $renewalWindow,
        int $includedDomains,
        int $maxDomains,
        array $requiredFields,
        array $optionalFields
    ) {
        $this->product = $product;
        $this->brand = $brand;
        $this->name = $name;
        $this->validationType = $validationType;
        $this->certificateType = $certificateType;
        $this->features = $features;
        $this->periods = $periods;
        $this->warranty = $warranty;
        $this->issueTime = $issueTime;
        $this->renewalWindow = $renewalWindow;
        $this->includedDomains = $includedDomains;
        $this->maxDomains = $maxDomains;
        $this->requiredFields = $requiredFields;
        $this->optionalFields = $optionalFields;
    }

    public static function fromArray(array $json): Product
    {
        CertificateTypeEnum::validate($json['certificateType']);
        // FeatureEnum::validate($json['status']);
        ValidationTypeEnum::validate($json['validationType']);

        return new Product(
            $json['product'],
            $json['brand'],
            $json['name'],
            $json['validationType'],
            $json['certificateType'],
            $json['features'],
            $json['periods'],
            $json['warranty'],
            $json['issueTime'],
            $json['renewalWindow'],
            $json['includedDomains'],
            $json['maxDomains'],
            $json['requiredFields'],
            $json['optionalFields']
        );
    }

    public function toArray(): array
    {
        return [
            'product' => $this->product,
            'brand' => $this->brand,
            'name' => $this->name,
            'validationType' => $this->validationType,
            'certificateType' => $this->certificateType,
            'features' => $this->features,
            'periods' => $this->periods,
            'warranty' => $this->warranty,
            'issueTime' => $this->issueTime,
            'renewalWindow' => $this->renewalWindow,
            'includedDomains' => $this->includedDomains,
            'maxDomains' => $this->maxDomains,
            'requiredFields' => $this->requiredFields,
            'optionalFields' => $this->optionalFields,
        ];
    }
}
