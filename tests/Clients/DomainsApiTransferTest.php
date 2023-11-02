<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use JsonException;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\BillableCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainContactCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainQuote;
use SandwaveIo\RealtimeRegister\Domain\Enum\BillableActionEnum;
use SandwaveIo\RealtimeRegister\Domain\KeyDataCollection;
use SandwaveIo\RealtimeRegister\Domain\Zone;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiTransferTest extends TestCase
{
    public function test_transfer_quote(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/domain_transfer_quote.php'),
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/transfer', $this)
        );

        $response = $sdk->domains->transfer(
            domainName: 'example.com',
            customer: 'test',
            registrant: 'John Doe',
            privacyProtect: false,
            period: 12,
            authcode: '123123123',
            autoRenew: true,
            ns: [],
            transferContacts: 'test',
            designatedAgent: 'OLD',
            zone: Zone::fromArray(include __DIR__ . '/../Domain/data/zone_valid.php'),
            contacts: DomainContactCollection::fromArray([include __DIR__ . '/../Domain/data/domain_contact_valid.php']),
            keyData: KeyDataCollection::fromArray([include __DIR__ . '/../Domain/data/key_data_valid.php']),
            billables: BillableCollection::fromArray([include __DIR__ . '/../Domain/data/billable_valid.php']),
            isQuote: true,
        );

        $this->assertInstanceOf(DomainQuote::class, $response);
        $this->assertSame(BillableActionEnum::ACTION_TRANSFER, $response->quote->billables[0]->action);
    }

    /**
     * @throws JsonException
     */
    public function test_transfer(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/domain_transfer_valid.php', JSON_THROW_ON_ERROR),
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
