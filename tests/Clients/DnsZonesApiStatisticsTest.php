<?php

declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\DomainZoneStatistics;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsZonesApiStatisticsTest extends TestCase
{
    public function test_statistics(): void
    {
        $zoneId = 1;

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(['queries' => [['date' => '2020-02-20', 'qcount' => 42, 'nxcount' => 1337]]]),
            MockedClientFactory::assertRoute('GET', "v2/dns/zones/{$zoneId}/stats", $this)
        );

        $result = $sdk->dnszones->statistics($zoneId);

        $this->assertInstanceOf(DomainZoneStatistics::class, $result);
    }
}
