<?php declare(strict_types = 1);

namespace Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainZoneApiDeleteTest extends TestCase
{
    public function test_delete(): void
    {
        $zoneId = 1;

        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('DELETE', "v2/dns/zones/{$zoneId}", $this)
        );

        $sdk->dnszones->delete($zoneId);
    }
}
