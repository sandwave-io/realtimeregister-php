<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\TLDInfo;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class TLDsApiInfoTest extends TestCase
{
    public function test_info(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/tldinfo.php'),
            MockedClientFactory::assertRoute('GET', 'v2/tlds/nl/info', $this)
        );

        $response = $sdk->tlds->info('nl');
        $this->assertInstanceOf(TLDInfo::class, $response);
    }
}
