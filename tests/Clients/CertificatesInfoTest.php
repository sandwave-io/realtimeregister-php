<?php declare(strict_types = 1);

namespace Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\CertificateInfoProcess;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesInfoTest extends TestCase
{
    public function test_info_dns(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/certificate_info_process_dns.php'),
            MockedClientFactory::assertRoute('GET', '/v2/processes/1/info', $this)
        );

        $information = $sdk->certificates->info(1);
        self::assertInstanceOf(CertificateInfoProcess::class, $information);
    }

    public function test_info_docs(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/certificate_info_process_docs.php'),
            MockedClientFactory::assertRoute('GET', '/v2/processes/1/info', $this)
        );

        $information = $sdk->certificates->info(1);
        self::assertInstanceOf(CertificateInfoProcess::class, $information);
    }

    public function test_info_voice(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/certificate_info_process_voice.php'),
            MockedClientFactory::assertRoute('GET', '/v2/processes/1/info', $this)
        );

        $information = $sdk->certificates->info(1);
        self::assertInstanceOf(CertificateInfoProcess::class, $information);
    }

    public function test_info_whois(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/certificate_info_process_whois.php'),
            MockedClientFactory::assertRoute('GET', '/v2/processes/1/info', $this)
        );

        $information = $sdk->certificates->info(1);
        self::assertInstanceOf(CertificateInfoProcess::class, $information);
    }
}
