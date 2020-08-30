<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Contact;
use SandwaveIo\RealtimeRegister\Domain\Country;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiGetCountryTest extends TestCase
{
    public function test_get_country(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/country_valid.php'),
            MockedClientFactory::assertRoute('GET', 'v2/countries/nl', $this)
        );

        $response = $sdk->contacts->getCountry('nl');
        $this->assertInstanceOf(Country::class, $response);
    }
}
