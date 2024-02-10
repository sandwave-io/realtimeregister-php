<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\DomainZoneRecordCollection;
use SandwaveIo\RealtimeRegister\Domain\Enum\ZoneServiceEnum;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsZonesApiUpdateTest extends TestCase
{
    public function test_update(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/dns/zones/1111111111/update', $this)
        );

        $sdk->dnszones->update(
            1111111111,
            'test',
            ZoneServiceEnum::BASIC,
            'magazine',
            false,
        );
    }

    public function test_update_with_records(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/dns/zones/1111111111/update', $this)
        );

        $sdk->dnszones->update(
            1111111111,
            'test',
            ZoneServiceEnum::BASIC,
            'magazine',
            false,
            'master',
            ['ns1.donaldduck.nl', 'ns2.donaldduck.nl'],
            false,
            'movies@ducktown.disney.com',
            129371293,
            123456,
            78123139,
            712312377,
            DomainZoneRecordCollection::fromArray(
                [
                    [
                        'name' => '##DOMAIN##',
                        'type' => 'URL',
                        'content' => 'http://www.donaldduck.nl/',
                        'ttl' => 300,
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
    }

    public function test_update_invalid(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            ''
        );
        $this->expectException('Webmozart\Assert\InvalidArgumentException');
        $sdk->dnszones->update(
            1111111111,
            'this is not possible',
            ZoneServiceEnum::PREMIUM,
        );
    }
}
