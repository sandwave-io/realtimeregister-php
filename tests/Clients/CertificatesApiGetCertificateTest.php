<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Enum\CertificateTypeEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\PublicKeyAlgorithmEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\StatusEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\ValidationTypeEnum;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiGetCertificateTest extends TestCase
{
    public function test_get(): void
    {
        $startDate = new DateTimeImmutable();
        $expiryDate = new DateTimeImmutable('+1 year');

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'id' => 1,
                'product' => 'ssl',
                'validationType' => ValidationTypeEnum::VALIDATION_TYPE_DOMAIN_VALIDATION,
                'certificateType' => CertificateTypeEnum::LOCALE_SINGLE_DOMAIN,
                'domainName' => 'example.com',
                'organization' => 'Example',
                'department' => 'Example department',
                'addressLine' => [
                    'ExampleStr. 1',
                ],
                'city' => 'Amsterdam',
                'state' => 'Noord-Holland',
                'postalCode' => '1234AB',
                'country' => 'The Netherlands',
                'coc' => '12345678',
                'providerId' => 'provider',
                'startDate' => $startDate->format('Y-m-d H:i:s'),
                'expiryDate' => $expiryDate->format('Y-m-d H:i:s'),
                'san' => [],
                'status' => StatusEnum::STATUS_ACTIVE,
                'publicKeyAlgorithm' => PublicKeyAlgorithmEnum::PUBLIC_KEY_ALGORITHM_RSA,
                'publicKeySize' => 4092,
                'csr' => 'csr',
                'certificate' => 'certificate',
                'fingerprint' => 'fingerprint',
            ]),
            MockedClientFactory::assertRoute('GET', '/v2/ssl/certificates/1', $this)
        );

        $certificate = $sdk->certificates->getCertificate(1);

        self::assertSame(1, $certificate->id);
        self::assertSame('ssl', $certificate->product);
        self::assertSame(ValidationTypeEnum::VALIDATION_TYPE_DOMAIN_VALIDATION, $certificate->validationType);
        self::assertSame(CertificateTypeEnum::LOCALE_SINGLE_DOMAIN, $certificate->certificateType);
        self::assertSame('example.com', $certificate->domainName);
        self::assertSame('Example', $certificate->organization);
        self::assertSame('Example department', $certificate->department);
        self::assertSame(['ExampleStr. 1'], $certificate->addressLine);
        self::assertSame('Amsterdam', $certificate->city);
        self::assertSame('Noord-Holland', $certificate->state);
        self::assertSame('1234AB', $certificate->postalCode);
        self::assertSame('The Netherlands', $certificate->country);
        self::assertSame('12345678', $certificate->coc);
        self::assertSame('provider', $certificate->providerId);
        self::assertSame($startDate->getTimestamp(), $certificate->startDate->getTimestamp());
        self::assertSame($expiryDate->getTimestamp(), $certificate->expiryDate->getTimestamp());
        self::assertSame([], $certificate->san);
        self::assertSame(StatusEnum::STATUS_ACTIVE, $certificate->status);
        self::assertSame(PublicKeyAlgorithmEnum::PUBLIC_KEY_ALGORITHM_RSA, $certificate->publicKeyAlgorithm);
        self::assertSame(4092, $certificate->publicKeySize);
        self::assertSame('csr', $certificate->csr);
        self::assertSame('certificate', $certificate->certificate);
        self::assertSame('fingerprint', $certificate->fingerprint);
    }
}
