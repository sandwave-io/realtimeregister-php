<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\DnsHostAddressCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsHostsApiCreateTest extends TestCase
{
    public function test_create(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/hosts/ns1.example.com', $this)
        );

        $sdk->hosts->create(
            'ns1.example.com',
        );
    }

    public function test_create_with_only_ipv6(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/hosts/ns2.example.com', $this)
        );

        $sdk->hosts->create(
            'ns2.example.com',
            DnsHostAddressCollection::fromArray([
                [
                    'ipVersion' => 'V6',
                    'address' => '::1',
                ],
            ])
        );
    }

    public function test_create_with_details(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/hosts/ns3.example.com', $this)
        );

        $sdk->hosts->create(
            'ns3.example.com',
            DnsHostAddressCollection::fromArray([
               [
                   'ipVersion' => 'V4',
                   'address' => '127.0.0.1',
               ],
                [
                    'ipVersion' => 'V6',
                    'address' => '::1',
                ],
            ])
        );
    }
}
