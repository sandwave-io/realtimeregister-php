<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class ContactsApiSplitTest extends TestCase
{
    public function test_split(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            201,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test/split', $this)
        );

        $sdk->contacts->split('johndoe', 'test', 'test2');
    }

    public function test_split_registries(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            201,
            '',
            MockedClientFactory::assertRoute('POST', 'v2/customers/johndoe/contacts/test/split', $this)
        );

        $sdk->contacts->split('johndoe', 'test', 'test2', ['sidn']);
    }
}
