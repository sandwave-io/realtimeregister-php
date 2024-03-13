<?php declare(strict_types = 1);

namespace Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\DomainZoneCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainZoneApiListTest extends TestCase
{
    public function test_list(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/domain_zone_details.php',
                    include __DIR__ . '/../Domain/data/domain_zone_details.php',
                    include __DIR__ . '/../Domain/data/domain_zone_details.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/dns/zones', $this)
        );

        $response = $sdk->dnszones->list();
        $this->assertInstanceOf(DomainZoneCollection::class, $response);
    }

    public function test_list_with_queries(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/domain_zone_details.php',
                    include __DIR__ . '/../Domain/data/domain_zone_details.php',
                    include __DIR__ . '/../Domain/data/domain_zone_details.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 3,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/dns/zones', $this)
        );

        $response = $sdk->dnszones->list(3, 0, ['BASIC']);
        $this->assertInstanceOf(DomainZoneCollection::class, $response);
    }
}
