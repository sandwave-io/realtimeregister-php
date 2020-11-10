<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use DateTime;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\BillableCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiRenewTest extends TestCase
{
    public function test_renew(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(['expiryDate' => '2020-03-04 12:34:56']),
            MockedClientFactory::assertRoute('POST', 'v2/domains/example.com/renew', $this)
        );

        $expiry = $sdk->domains->renew('example.com', 12, BillableCollection::fromArray([
            include __DIR__ . '/../Domain/data/billable_valid.php',
            include __DIR__ . '/../Domain/data/billable_valid.php',
        ]));

        $this->assertInstanceOf(DateTime::class, $expiry);
        $this->assertSame('2020-03-04 12:34:56', $expiry->format('Y-m-d H:i:s'));
    }
}
