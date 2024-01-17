<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use DateTime;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\BillableCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainQuote;
use SandwaveIo\RealtimeRegister\Domain\Enum\BillableActionEnum;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiRestoreTest extends TestCase
{
    public function test_restore_quote(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/domain_restore_quote.php'),
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/restore', $this)
        );

        $response = $sdk->domains->restore(
            domain: 'example.com',
            reason: 'just.. because!',
            billables: BillableCollection::fromArray([
                include __DIR__ . '/../Domain/data/billable_valid.php',
                include __DIR__ . '/../Domain/data/billable_valid.php',
            ]),
            isQuote: true
        );

        $this->assertInstanceOf(DomainQuote::class, $response);
        $this->assertSame(BillableActionEnum::ACTION_RESTORE, $response->quote->billables[0]->action);
    }

    public function test_restore(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(['expiryDate' => '2020-03-04 12:34:56']),
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/restore', $this)
        );

        $expiry = $sdk->domains->restore('example.com', 'just.. because!', BillableCollection::fromArray([
            include __DIR__ . '/../Domain/data/billable_valid.php',
            include __DIR__ . '/../Domain/data/billable_valid.php',
        ]));

        $this->assertInstanceOf(DateTime::class, $expiry);
        $this->assertSame('2020-03-04 12:34:56', $expiry->format('Y-m-d H:i:s'));
    }
}
