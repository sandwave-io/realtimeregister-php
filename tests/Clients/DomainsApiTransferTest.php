<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use JsonException;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\BillableCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainContactCollection;
use SandwaveIo\RealtimeRegister\Domain\KeyDataCollection;
use SandwaveIo\RealtimeRegister\Domain\Zone;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiTransferTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function test_transfer(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/domain_transfer_status.php', JSON_THROW_ON_ERROR),
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/transfer', $this)
        );

        $sdk->domains->transfer(
            'example.com',
            'test',
            'John Doe',
            false,
            12,
            '123123123',
            true,
            [],
            'test',
            'OLD',
            Zone::fromArray(include __DIR__ . '/../Domain/data/zone_valid.php'),
            DomainContactCollection::fromArray([include __DIR__ . '/../Domain/data/domain_contact_valid.php']),
            KeyDataCollection::fromArray([include __DIR__ . '/../Domain/data/key_data_valid.php']),
            BillableCollection::fromArray([include __DIR__ . '/../Domain/data/billable_valid.php'])
        );
    }
}
