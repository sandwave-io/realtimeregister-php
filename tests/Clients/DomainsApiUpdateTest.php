<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\BillableCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainContactCollection;
use SandwaveIo\RealtimeRegister\Domain\KeyDataCollection;
use SandwaveIo\RealtimeRegister\Domain\Zone;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiUpdateTest extends TestCase
{
    public function test_update(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/update', $this)
        );

        $sdk->domains->update(
            'example.com',
            'John Doe',
            false,
            12,
            '123123123',
            'nl',
            true,
            [],
            ['OK'],
            'OLD',
            Zone::fromArray(include __DIR__ . '/../Domain/data/zone_valid.php'),
            DomainContactCollection::fromArray([include __DIR__ . '/../Domain/data/contact_handle_valid.php']),
            KeyDataCollection::fromArray([include __DIR__ . '/../Domain/data/key_data_valid.php']),
            BillableCollection::fromArray([include __DIR__ . '/../Domain/data/billable_valid.php'])
        );
    }
}
