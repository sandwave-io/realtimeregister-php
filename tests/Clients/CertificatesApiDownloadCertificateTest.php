<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Enum\CertificateTypeEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\PublicKeyAlgorithmEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\StatusEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\ValidationTypeEnum;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiDownloadCertificateTest extends TestCase
{
    public function test_download(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            'RAW_BASE64ENCODED_DATA'
        );

        $data = $sdk->certificates->downloadCertificate(1);

        self::assertSame($data, 'RAW_BASE64ENCODED_DATA');
    }
}
