<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Downtime;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ProvidersApiGetDowntimeTest extends TestCase
{
    public function test_get_downtime(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/downtime_valid.php'),
            MockedClientFactory::assertRoute('GET', '/v2/providers/downtime/1', $this)
        );

        $response = $sdk->providers->getDowntime(1);
        $this->assertInstanceOf(Downtime::class, $response);
    }
}
