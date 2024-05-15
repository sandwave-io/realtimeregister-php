<?php declare(strict_types = 1);

namespace Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\DomainControlValidationCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificateApiProcessResendTest extends TestCase
{
    public function test_resend_dcv(): void
    {
        $certificateId = 1;
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/certificate_process_resend.php'),
            MockedClientFactory::assertRoute('POST', '/v2/processes/' . $certificateId . '/resend', $this)
        );

        $result = $sdk->certificates->resendDcv(
            1,
            DomainControlValidationCollection::fromArray(include __DIR__ . '/../Domain/data/domain_control_validation.php')
        );

        self::assertArrayHasKey('commonName', $result);
        self::assertSame('example', $result['commonName']);
    }
}
