<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\ContactCollection;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiListTest extends TestCase
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

    public function test_list_with_queries(): void
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
                    'limit'  => 3,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/contacts', $this)
        );

        $response = $sdk->contacts->list('johndoe', 3, 0, 'john');
        $this->assertInstanceOf(ContactCollection::class, $response);
    }

    public function test_list_with_search_and_parameters(): void
    {
        $parameters = [
            'organization' => 'testorg'
        ];

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
                    'limit'  => 3,
                ],
            ]),
            MockedClientFactory::assertRoute('GET', 'v2/customers/johndoe/contacts', $this, [
                'organization' => 'testorg',
                'limit' => '3',
                'offset' => '0',
                'q' => 'john'
            ])
        );

        $response = $sdk->contacts->list('johndoe', 3, 0, 'john', $parameters);
        $this->assertInstanceOf(ContactCollection::class, $response);
    }
}
