<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\ProviderCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ProvidersApiListTest extends TestCase
{
    public function test_list(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/provider_valid.php',
                    include __DIR__ . '/../Domain/data/provider_valid.php',
                    include __DIR__ . '/../Domain/data/provider_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/providers', $this)
        );

        $response = $sdk->providers->list();
        $this->assertInstanceOf(ProviderCollection::class, $response);
    }

    public function test_list_with_queries(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/provider_valid.php',
                    include __DIR__ . '/../Domain/data/provider_valid.php',
                    include __DIR__ . '/../Domain/data/provider_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 3,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/providers', $this)
        );

        $response = $sdk->providers->list(3, 0, 'providername');
        $this->assertInstanceOf(ProviderCollection::class, $response);
    }

    public function test_list_with_search_and_parameters(): void
    {
        $parameters = [
            'name:like' => 'testname',
        ];

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/provider_valid.php',
                    include __DIR__ . '/../Domain/data/provider_valid.php',
                    include __DIR__ . '/../Domain/data/provider_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 3,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/providers', $this, [
                'name:like' => 'testname',
                'limit' => '3',
                'offset' => '0',
                'q' => 'providername',
            ])
        );

        $response = $sdk->providers->list(3, 0, 'providername', $parameters);
        $this->assertInstanceOf(ProviderCollection::class, $response);
    }
}
