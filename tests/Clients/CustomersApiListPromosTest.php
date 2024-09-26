<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\PromoCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CustomersApiListPromosTest extends TestCase
{
    public function test_list_promos(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'promos' => [
                    include __DIR__ . '/../Domain/data/promo_valid.php',
                    include __DIR__ . '/../Domain/data/promo_valid.php',
                    include __DIR__ . '/../Domain/data/promo_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/pricelist', $this)
        );

        $response = $sdk->customers->promoList('johndoe');
        $this->assertInstanceOf(PromoCollection::class, $response);
    }
}
