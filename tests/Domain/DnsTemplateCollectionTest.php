<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Domain;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\DnsTemplate;
use SandwaveIo\RealtimeRegister\Domain\DnsTemplateCollection;

final class DnsTemplateTest extends TestCase
{
    public function test_from_array(): void
    {
        $dnsTemplateCollectionData = include __DIR__ . '/data/dnstemplatecollection_valid.php';

        $dnsTemplateCollection = DnsTemplateCollection::fromArray($dnsTemplateCollectionData);

        Assert::assertCount(3, $dnsTemplateCollection);

        $dnsTemplate = $dnsTemplateCollection->offsetGet(1);

        assert($dnsTemplate !== null);

        Assert::assertInstanceOf(DnsTemplate::class, $dnsTemplate);
        Assert::assertSame('dns@savvii.com', $dnsTemplate->hostMaster);

        $dnsTemplate = $dnsTemplateCollection->offsetGet(2);

        assert($dnsTemplate !== null);

        Assert::assertInstanceOf(DnsTemplate::class, $dnsTemplate);
        Assert::assertSame('whiskey', $dnsTemplate->name);
    }

    public function test_from_and_to_array(): void
    {
        $dnsTemplateCollectionData = include __DIR__ . '/data/dnstemplatecollection_valid.php';

        $dnsTemplateCollection = DnsTemplateCollection::fromArray($dnsTemplateCollectionData);

        Assert::assertSame($dnsTemplateCollectionData, $dnsTemplateCollection->toArray());
    }

    public function test_set_unset_exists(): void
    {
        $dnsTemplateCollectionData = include __DIR__ . '/data/dnstemplatecollection_valid.php';

        $dnsTemplateCollection = DnsTemplateCollection::fromArray($dnsTemplateCollectionData);
        $dnsTemplateCollection->offsetSet(
            '3',
            DnsTemplate::fromArray([
                'customer'   => 'coca',
                'name'       => 'cola',
                'hostMaster' => 'drink@fresh.com',
                'refresh'    => 123,
                'retry'      => 456,
                'expire'     => 789,
                'ttl'        => 777
            ])
        );

        Assert::assertTrue($dnsTemplateCollection->offsetExists(3));

        $dnsTemplate = $dnsTemplateCollection->offsetGet(3);

        assert($dnsTemplate !== null);

        Assert::assertSame('cola', $dnsTemplate->name);

        $dnsTemplateCollection->offsetUnset(3);

        Assert::assertNull($dnsTemplateCollection->offsetGet(3));
        Assert::assertFalse($dnsTemplateCollection->offsetExists(3));
    }
}
