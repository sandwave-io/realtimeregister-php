<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiRevokeCertificateTest extends TestCase
{
    public function test_revoke(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            202,
            '',
            MockedClientFactory::assertRoute('DELETE', '/v2/ssl/certificates/1', $this)
        );

        $sdk->certificates->revokeCertificate(1, 'reason');
    }
}
