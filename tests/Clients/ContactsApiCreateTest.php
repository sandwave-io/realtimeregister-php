<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiCreateTest extends TestCase
{
    public function test_create(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test', $this)
        );

        $sdk->contacts->create(
            'johndoe',
            'test',
            'John Doe',
            ['Theoreticalstreet 1'],
            '1234AB',
            'TheoreticalCity',
            'TheoreticalCountry',
            'test@example.com',
            '+31655555555'
        );
    }

    public function test_create_with_details(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test', $this)
        );

        $sdk->contacts->create(
            'johndoe',
            'test',
            'John Doe',
            ['Theoreticalstreet 1'],
            '1234AB',
            'TheoreticalCity',
            'TheoreticalCountry',
            'test@example.com',
            '+31655555555',
            'Acme Corp',
            'Acme Corp',
            'TheoreticalState',
            '+31655555555'
        );
    }
}
