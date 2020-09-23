<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\DomainTransferStatus;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiTransferInfoTest extends TestCase
{
    public function test_push_transfer(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/domain_transfer_status.php'),
            MockedClientFactory::assertRoute('GET', 'v2/domains/example.com/transfer/1804892', $this)
        );

        $response = $sdk->domains->transferInfo('example.com', '1804892');
        $this->assertInstanceOf(DomainTransferStatus::class, $response);
    }
}
