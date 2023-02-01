<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiZoneUpdateTest extends TestCase
{
    public function test_update(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/zone/update', $this)
        );

        $sdk->domains->zoneUpdate(
            'example.com',
            'hostmaster@example.com',
            3600,
            3600,
            1209600,
            3600,
            [],
        );
    }
}
