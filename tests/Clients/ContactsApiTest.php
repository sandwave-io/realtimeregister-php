<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Contact;
use SandwaveIo\RealtimeRegister\Domain\ContactCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiTest extends TestCase
{
    public function test_list(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'entities' => [
                    include __DIR__ . '/../Domain/data/contact_valid.php',
                    include __DIR__ . '/../Domain/data/contact_valid.php',
                    include __DIR__ . '/../Domain/data/contact_valid.php',
                ],
                'pagination' => [
                    'total'  => 3,
                    'offset' => 0,
                    'limit'  => 10,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/contacts', $this)
        );

        $response = $sdk->contacts->list('johndoe');
        $this->assertInstanceOf(ContactCollection::class, $response);
    }

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
