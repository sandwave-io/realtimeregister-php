<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Contact;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiGetTest extends TestCase
{
    public function test_get(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode(include __DIR__ . '/../Domain/data/contact_valid.php'),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/contacts/test', $this)
        );

        $response = $sdk->contacts->get('johndoe', 'test');
        $this->assertInstanceOf(Contact::class, $response);
    }
}
