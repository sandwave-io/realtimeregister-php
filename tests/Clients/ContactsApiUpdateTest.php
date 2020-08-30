<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiUpdateTest extends TestCase
{
    public function test_update(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test/update', $this)
        );

        $sdk->contacts->update(
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
