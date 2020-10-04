<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Provider;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ProvidersApiGetTest extends TestCase
{
    public function test_get(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/provider_valid.php'),
            MockedClientFactory::assertRoute('GET', '/v2/providers/REGISTRY/providername', $this)
        );

        $response = $sdk->providers->get('providername');
        $this->assertInstanceOf(Provider::class, $response);
    }
}
