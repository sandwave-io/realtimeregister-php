<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\BillableCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainContactCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainRegistration;
use SandwaveIo\RealtimeRegister\Domain\KeyDataCollection;
use SandwaveIo\RealtimeRegister\Domain\Zone;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiRegisterTest extends TestCase
{
    public function test_register(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/domain_registration_valid.php'),
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com', $this)
        );

        $registration = $sdk->domains->register(
            'example.com',
            'test',
            'John Doe'
        );

        $this->assertInstanceOf(DomainRegistration::class, $registration);
    }

    public function test_register_with_details(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/domain_registration_valid.php'),
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com', $this)
        );

        $registration = $sdk->domains->register(
            'example.com',
            'test',
            'John Doe',
            false,
            12,
            '123123123',
            'nl',
            true,
            [],
            false,
            null,
            Zone::fromArray(include __DIR__ . '/../Domain/data/zone_valid.php'),
            DomainContactCollection::fromArray([include __DIR__ . '/../Domain/data/domain_contact_valid.php']),
            KeyDataCollection::fromArray([include __DIR__ . '/../Domain/data/key_data_valid.php']),
            BillableCollection::fromArray([include __DIR__ . '/../Domain/data/billable_valid.php'])
        );

        $this->assertInstanceOf(DomainRegistration::class, $registration);
    }
}
