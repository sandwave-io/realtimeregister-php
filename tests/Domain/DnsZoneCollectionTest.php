<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Domain;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\DnsZone;
use SandwaveIo\RealtimeRegister\Domain\DnsZoneCollection;

final class DnsZoneCollectionTest extends TestCase
{
    public function test_from_array(): void
    {
        $dnsZoneCollectionData = include __DIR__ . '/data/dnszonecollection_valid.php';

        $dnsZoneCollection = DnsZoneCollection::fromArray($dnsZoneCollectionData);

        Assert::assertCount(2, $dnsZoneCollection);

        $dnsTemplate = $dnsZoneCollection->offsetGet(1);

        assert($dnsTemplate !== null);

        Assert::assertInstanceOf(DnsZone::class, $dnsTemplate);
        Assert::assertSame('john.doe@example.com', $dnsTemplate->hostMaster);
    }

    public function test_from_and_to_array(): void
    {
        $dnsZoneCollectionData = include __DIR__ . '/data/dnszonecollection_valid.php';

        $dnsZoneCollection = DnsZoneCollection::fromArray($dnsZoneCollectionData);

        Assert::assertSame($dnsZoneCollectionData, $dnsZoneCollection->toArray());
    }

    public function test_set_unset_exists(): void
    {
        $dnsZoneCollectionData = include __DIR__ . '/data/dnszonecollection_valid.php';

        $dnsZoneCollection = DnsZoneCollection::fromArray($dnsZoneCollectionData);
        $dnsZoneCollection->offsetSet(
            '3',
            DnsZone::fromArray([
                'id'             => 333333,
                'customer'       => 'coca',
                'name'           => 'cola',
                'hostMaster'     => 'drink@fresh.com',
                'createdDate'    => '2024-02-08T14:40:00Z',
                'service'        => 'BASIC',
                'managed'        => false,
                'dnssec'         => false,
                'defaultRecords' => [],
                'refresh'        => 123,
                'retry'          => 456,
                'expire'         => 789,
                'ttl'            => 777,
            ])
        );

        Assert::assertTrue($dnsZoneCollection->offsetExists(3));

        $dnsTemplate = $dnsZoneCollection->offsetGet(3);

        assert($dnsTemplate !== null);

        Assert::assertSame('cola', $dnsTemplate->name);

        $dnsZoneCollection->offsetUnset(3);

        Assert::assertNull($dnsZoneCollection->offsetGet(3));
        Assert::assertFalse($dnsZoneCollection->offsetExists(3));
    }
}
