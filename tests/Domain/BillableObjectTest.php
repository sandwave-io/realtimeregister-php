<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Domain;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Billable;
use ValueError;

/**
 * This TestCase is used to test all single Billable Objects.
 * If you want to test Collections, use the BillableCollectionTest instead.
 */
class BillableObjectTest extends TestCase
{
    public static function parserDataSet(): array
    {
        /**
         * This data provider has three fields, the last one of which is optional.
         *  - Class: The data class that is tested.
         *  - Data: A data array, most commonly by including a php file.
         *  - Exception: (nullable), the exception to expect. If null: no exception should occur.
         */
        return [
            'valid billables' => [
                Billable::class,
                include __DIR__ . '/data/billable_valid.php',
            ],
            'valid billables with nullables' => [
                Billable::class,
                include __DIR__ . '/data/billable_valid_with_nullables.php',
            ],
            'invalid billable action' => [
                Billable::class,
                include __DIR__ . '/data/billable_invalid_action.php',
                ValueError::class,
            ],
        ];
    }

    /** @dataProvider parserDataSet */
    public function test_from_and_to_array(string $class, array $data, ?string $exception = null): void
    {
        // In case of invalid data.
        if ($exception) {
            self::expectException($exception);
        }
        // Object from array
        $object = call_user_func($class . '::fromArray', $data);
        self::assertSame($class, get_class($object), "{$class}::fromArray(array \$json) gave an unexpected result.");

        // Object to array
        $array = $object->toArray();
        self::assertSame($data, $array, "{$class}::toArray() gave an unexpected result.");
    }
}
