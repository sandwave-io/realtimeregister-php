<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiScheduleValidationCallTest extends TestCase
{
    public function test_schedule(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', '/v2/processes/1/schedule-validation-call', $this)
        );

        $sdk->certificates->scheduleValidationCall(1, new DateTimeImmutable());
    }
}
