<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DnsTemplatesApiGetTest extends TestCase
{
    public function test_get(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/dnstemplate_valid_with_records.php'),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/dnstemplates/test', $this)
        );

        $response = $sdk->dnstemplates->get('johndoe', 'test');
        $this->assertSame(2, $response->records->count());
    }

    public function test_get_invalid(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            404,
            ''
        );

        $this->expectException(\InvalidArgumentException::class);
        $sdk->dnstemplates->get('johndoe', 'this is not OK');
    }
}
