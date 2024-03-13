<?php declare(strict_types = 1);

namespace Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainZoneApiKeyRolloverTest extends TestCase
{
    public function test_key_rollover(): void
    {
        $zoneId = 1;

        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', "v2/dns/zones/{$zoneId}/key-rollover", $this)
        );

        $sdk->dnszones->keyRollover($zoneId);
    }
}
