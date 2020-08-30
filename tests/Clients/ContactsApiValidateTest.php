<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiValidateTest extends TestCase
{
    public function test_validate(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            201,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test/validate', $this)
        );

        $sdk->contacts->validate('johndoe', 'test', ['General', 'DkHostmaster']);
    }

    public function test_validate_registries(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            201,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test/validate', $this)
        );

        $this->expectException(InvalidArgumentException::class);
        $sdk->contacts->validate('johndoe', 'test', ['General', 'InvalidCategory']);
    }
}
