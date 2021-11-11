<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\CountryCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiListCountriesTest extends TestCase
{
    public function test_list_countries(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/country_valid.php',
                    include __DIR__ . '/../Domain/data/country_valid.php',
                    include __DIR__ . '/../Domain/data/country_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/countries', $this)
        );

        $response = $sdk->contacts->listCountries();
        $this->assertInstanceOf(CountryCollection::class, $response);
    }

    public function test_list_countries_with_query(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/country_valid.php',
                    include __DIR__ . '/../Domain/data/country_valid.php',
                    include __DIR__ . '/../Domain/data/country_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/countries', $this)
        );

        $response = $sdk->contacts->listCountries(10, 0, 'nl');
        $this->assertInstanceOf(CountryCollection::class, $response);
    }

    public function test_list_with_search_and_parameters(): void
    {
        $parameters = [
            'code' => 'NL',
        ];

        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/country_valid.php',
                    include __DIR__ . '/../Domain/data/country_valid.php',
                    include __DIR__ . '/../Domain/data/country_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/countries', $this, [
                'code' => 'NL',
                'limit' => '10',
                'offset' => '0',
                'q' => 'nl',
            ])
        );

        $response = $sdk->contacts->listCountries(10, 0, 'nl', $parameters);
        $this->assertInstanceOf(CountryCollection::class, $response);
    }
}
