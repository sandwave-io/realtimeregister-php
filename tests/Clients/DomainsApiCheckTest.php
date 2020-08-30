<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Contact;
use SandwaveIo\RealtimeRegister\Domain\CountryCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainAvailabilityCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainDetailsCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class DomainsApiCheckTest extends TestCase
{
    public function test_check(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/domain_availability_valid.php',
                    include __DIR__ . '/../Domain/data/domain_availability_valid.php',
                    include __DIR__ . '/../Domain/data/domain_availability_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/domains/example.com/check', $this)
        );

        $response = $sdk->domains->check('example.com');
        $this->assertInstanceOf(DomainAvailabilityCollection::class, $response);
    }

    public function test_check_with_languageCode(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/domain_availability_valid.php',
                    include __DIR__ . '/../Domain/data/domain_availability_valid.php',
                    include __DIR__ . '/../Domain/data/domain_availability_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/domains/example.com/check', $this)
        );

        $response = $sdk->domains->check('example.com', 'nl');
        $this->assertInstanceOf(DomainAvailabilityCollection::class, $response);
    }
}
