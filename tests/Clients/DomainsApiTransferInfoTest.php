<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use JsonException;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiTransferInfoTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function test_transferinfo(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/domain_transfer_status.php', JSON_THROW_ON_ERROR),
            MockedClientFactory::assertRoute('GET', 'v2/domains/example.com/transfer/1804892', $this)
        );

        $sdk->domains->transferInfo('example.com', '1804892');
    }

    /**
     * @throws JsonException
     */
    public function test_transferinfo_no_processid(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/domain_transfer_status.php', JSON_THROW_ON_ERROR),
            MockedClientFactory::assertRoute('GET', 'v2/domains/example.com/transfer', $this)
        );

        $sdk->domains->transferInfo('example.com');
    }
}
