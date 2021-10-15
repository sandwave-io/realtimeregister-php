<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;
use Webmozart\Assert\Assert;

class ProcessesApiResendTest extends TestCase
{
    public function test_delete(): void
    {
        /** @var string $responseBody */
        $responseBody = json_encode(include __DIR__ . '/../Domain/data/process_valid.php');
        Assert::string($responseBody);
        $sdk = MockedClientFactory::makeSdk(
            200,
            $responseBody,
            MockedClientFactory::assertRoute('POST', 'v2/processes/123/resend', $this)
        );

        $sdk->processes->resend(123);
    }
}
