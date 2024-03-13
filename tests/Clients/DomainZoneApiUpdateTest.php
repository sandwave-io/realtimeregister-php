<?php declare(strict_types = 1);

namespace Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\DomainZoneRecordCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainZoneUpdate;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainZoneApiUpdateTest extends TestCase
{
    public function test_update_full(): void
    {
        $zoneId = 1;

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/zone_registration.php'),
            MockedClientFactory::assertRoute('POST', "v2/dns/zones/{$zoneId}/update", $this)
        );

        $registration = $sdk->dnszones->update(
            zoneId: $zoneId,
            template: 'template 1',
            master: '127.0.0.1',
            ns: [
                'ns01.example.com',
                'ns02.example.com',
            ],
            dnssec: true,
            hostMaster: 'hostmaster@example.com',
            refresh: 256,
            retry: 1,
            expire: 1,
            ttl: 1,
            records: DomainZoneRecordCollection::fromArray(
                [
                    [
                        'name'    => '##DOMAIN##',
                        'type'    => 'URL',
                        'content' => 'http://example.nl/',
                        'ttl'     => 300,
                    ],
                    [
                        'name' => 'www.##DOMAIN##',
                        'type' => 'A',
                        'content' => '1.1.1.1',
                        'ttl' => 300,
                    ],
                ]
            )
        );

        $this->assertInstanceOf(DomainZoneUpdate::class, $registration);
    }
}
