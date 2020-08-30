<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiAddPropertiesTest extends TestCase
{
    public function test_add_properties(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test/sidn', $this)
        );

        $sdk->contacts->addProperties('johndoe', 'test', 'sidn', [
            'is_verified' => 'true',
        ]);
    }

    public function test_add_properties_with_intended_usage(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test/sidn', $this)
        );

        $sdk->contacts->addProperties('johndoe', 'test', 'sidn', [
            'is_verified' => 'true',
        ], 'REGISTRANT');
    }

    public function test_add_properties_with_intended_usage_error(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test/sidn', $this)
        );

        $this->expectException(\InvalidArgumentException::class);
        $sdk->contacts->addProperties('johndoe', 'test', 'sidn', [
            'is_verified' => 'true',
        ], 'NOTHING');
    }
}
