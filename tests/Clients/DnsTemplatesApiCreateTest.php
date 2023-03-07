<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;
use SandwaveIo\RealtimeRegister\Domain\DomainZoneRecordCollection;

class DnsTemplatesApiCreateTest extends TestCase
{
    public function test_create(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/dnstemplates/test', $this)
        );

        $sdk->dnstemplates->create(
            'johndoe',
            'test',
            'john.doe@example.com',
            123,
            456,
            789,
            777
        );
    }

    public function test_create_with_records(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/dnstemplates/test', $this)
        );

        $sdk->dnstemplates->create(
            'johndoe',
            'test',
            'john.doe@example.com',
            123,
            456,
            789,
            777,
            DomainZoneRecordCollection::fromArray(
                [
                    [
                        'name'    => '##DOMAIN##',
                        'type'    => 'URL',
                        'content' => 'http://www.donaldduck.nl/',
                        'ttl'     => 300
                    ],
                    [
                        'name' => 'www.##DOMAIN##',
                        'type' => 'A',
                        'content' => '1.1.1.1',
                        'ttl' => 300
                    ]
                ]
            )
        );
    }

    public function test_create_invalid(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            ''
        );
        $this->expectException('Webmozart\Assert\InvalidArgumentException');
        $sdk->dnstemplates->create(
            'this is not possible',
            'test',
            'john.doe@example.com',
            123,
            456,
            789,
            777
        );
    }
}
