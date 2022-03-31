<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Certificate;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiListCertificatesTest extends TestCase
{
    public function test_list(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/certificate_valid.php',
                ],
                'pagination' => [
                    'total' => 1,
                    'offset' => 0,
                    'limit' => 5,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', '/v2/ssl/certificates', $this, [
                'limit' => '5',
                'offset' => '0',
                'q' => 'customer',
            ])
        );

        $certificates = $sdk->certificates->listCertificates(5, 0, 'customer');
        self::assertInstanceOf(Certificate::class, $certificates[0]);
    }
}
