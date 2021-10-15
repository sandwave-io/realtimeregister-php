<?php
declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Process;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;
use Webmozart\Assert\Assert;

class ProcessesApiGetTest extends TestCase
{
    public function test_get(): void
    {
        /** @var string $responseBody */
        $responseBody = json_encode(include __DIR__ . '/../Domain/data/process_valid.php');
        Assert::string($responseBody);
        $sdk = MockedClientFactory::makeSdk(
            200,
            $responseBody,
            MockedClientFactory::assertRoute('GET', 'v2/processes/46069000', $this)
        );

        $response = $sdk->processes->get(46069000);
        $this->assertInstanceOf(Process::class, $response);
    }
}
