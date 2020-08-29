<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Domain;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Account;
use TypeError;

class DomainObjectTest extends TestCase
{
    public function parserDataSet(): array
    {
        /**
         * This data provider has three fields, the last one of which is optional.
         *  - Class: The data class that is tested.
         *  - Data: A data array, most commonly by including a php file.
         *  - Exception: (nullable), the exception to expect. If null: no exception should occur.
         */
        return [
            [
                Account::class,
                include __DIR__.'/data/account_valid.php',
            ],
            [
                Account::class,
                include __DIR__.'/data/account_invalid_balance.php',
                TypeError::class
            ],
        ];
    }

    /** @dataProvider parserDataSet */
    public function test_from_and_to_array(string $class, array $data, ?string $exception = null): void
    {
        // In case of invalid data.
        if ($exception) {
            $this->expectException($exception);
        }
        // Object from array
        $object = call_user_func($class . '::fromArray', $data);
        $this->assertEquals($class, get_class($object), "{$class}::fromArray(array \$json) gave an unexpected result.");

        // Object to array
        $array = $object->toArray();
        $this->assertEquals($data, $array, "{$class}::toArray() gave an unexpected result.");
    }
}
