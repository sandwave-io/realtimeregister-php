<?php declare(strict_types = 1);

use SandwaveIo\RealtimeRegister\Domain\Enum\PublicKeyAlgorithmEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\StatusEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\ValidationTypeEnum;

return [
    'id' => 1234567,
    'product' => 'ssl_sectigo',
    'validationType' => ValidationTypeEnum::VALIDATION_TYPE_DOMAIN_VALIDATION,
    'certificateType' => 'INVALID',
    'domainName' => 'www.testingasslrequest.com',
    'organization' => 'Organization',
    'department' => 'Internet',
    'addressLine' => ['Somewhere 123'],
    'city' => 'Testtown',
    'state' => 'Province',
    'postalCode' => '1234AB',
    'country' => 'NL',
    'coc' => '1234567',
    'providerId' => '1029384756',
    'startDate' => '2022-03-18T13:37:20Z',
    'expiryDate' => '2023-03-18T13:37:20Z',
    'san' => ['test@test.com'],
    'status' => StatusEnum::STATUS_ACTIVE,
    'publicKeyAlgorithm' => PublicKeyAlgorithmEnum::PUBLIC_KEY_ALGORITHM_RSA,
    'publicKeySize' => 2048,
    'csr' => '-----BEGIN CERTIFICATE REQUEST-----\nMIIC6zCCAdMCAQAwgaUxCzAJBgNV\n-----END CERTIFICATE REQUEST-----',
    'certificate' => '-----BEGIN CERTIFICATE-----\nMIICvDCCAmagAwIBAgIEZbFqFDAN\r\n-----END CERTIFICATE-----',
    'fingerprint' => '79B4592590638C19AE71FA29FCD3A2CDBA560501F3788BB510B2176B2D97A29C',
];
