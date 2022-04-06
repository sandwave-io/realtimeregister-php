<?php declare(strict_types = 1);

use SandwaveIo\RealtimeRegister\Domain\Enum\CertificateTypeEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\FeatureEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\ValidationTypeEnum;

return [
    'product' => 'ssl',
    'brand' => 'brand',
    'name' => 'SSL',
    'validationType' => ValidationTypeEnum::VALIDATION_TYPE_DOMAIN_VALIDATION,
    'certificateType' => CertificateTypeEnum::LOCALE_MULTI_DOMAIN,
    'features' => [FeatureEnum::FEATURE_WILDCARD],
    'requiredFields' => ['dcv', 'address', 'postalCode'],
    'optionalFields' => ['organization'],
    'periods' => [1, 3, 6, 12],
    'warranty' => 50000,
    'issueTime' => '15-30 minutes',
    'renewalWindow' => 14,
    'includedDomains' => 5,
    'maxDomains' => 25,
];
