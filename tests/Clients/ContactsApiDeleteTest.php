<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiDeleteTest extends TestCase
{
    public function test_delete(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('DELETE', 'v2/customers/johndoe/contacts/test', $this)
        );

        $sdk->contacts->delete('johndoe', 'test');
    }
}
