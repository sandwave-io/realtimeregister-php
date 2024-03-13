<?php declare(strict_types = 1);

namespace Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainZoneApiRetrieveTest extends TestCase
{
    public function test_retrieve(): void
    {
        $zoneId = 1;

        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', "v2/dns/zones/{$zoneId}/retrieve", $this)
        );

        $sdk->dnszones->retrieve($zoneId);
    }
}
