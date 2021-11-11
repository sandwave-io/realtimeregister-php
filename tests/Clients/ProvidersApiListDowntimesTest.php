<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\DowntimeCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ProvidersApiListDowntimesTest extends TestCase
{
    public function test_list_downtimes(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/downtime_valid.php',
                    include __DIR__ . '/../Domain/data/downtime_valid.php',
                    include __DIR__ . '/../Domain/data/downtime_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/providers/downtime', $this)
        );

        $response = $sdk->providers->listDowntimes();
        $this->assertInstanceOf(DowntimeCollection::class, $response);
    }

    public function test_list_downtimes_with_queries(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/downtime_valid.php',
                    include __DIR__ . '/../Domain/data/downtime_valid.php',
                    include __DIR__ . '/../Domain/data/downtime_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/providers/downtime', $this)
        );

        $response = $sdk->providers->listDowntimes(10, 0, '');
        $this->assertInstanceOf(DowntimeCollection::class, $response);
    }

    public function test_list_with_search_and_parameters(): void
    {
        $parameters = [
            'name' => 'test',
        ];

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/downtime_valid.php',
                    include __DIR__ . '/../Domain/data/downtime_valid.php',
                    include __DIR__ . '/../Domain/data/downtime_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/providers/downtime', $this, [
                'name' => 'test',
                'limit' => '10',
                'offset' => '0',
                'q' => 'test',
            ])
        );

        $response = $sdk->providers->listDowntimes(10, 0, 'test', $parameters);
        $this->assertInstanceOf(DowntimeCollection::class, $response);
    }
}
