<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Domain;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Billable;
use SandwaveIo\RealtimeRegister\Domain\BillableCollection;

/**
 * This TestCase is used to test all Billable Object Collections.
 * If you want to test Billable Objects, use the BillableObjectTest instead.
 */
class BillableCollectionTest extends TestCase
{
    public static function parserDataSet(): array
    {
        /**
         * A flat and a pagination is generated for each scenario.
         * The arguments:
         *  - Class
         *  - Entity data.
         */
        $scenarios = [
            'billable collection' => [BillableCollection::class, include __DIR__ . '/data/billable_valid.php'],
        ];
        // For each type, create a flat and a pagination scenario.
        $dataset = [];
        foreach ($scenarios as $key => $scenario) {
            $dataset["{$key} (flat)"] = [
                $scenario[0],
                [$scenario[1], $scenario[1], $scenario[1]],
                3,
            ];
            $dataset["{$key} (pagination)"] = [
                $scenario[0],
                [
                    'entities' => [$scenario[1], $scenario[1], $scenario[1]],
                    'pagination' => [
                        'total'  => 3,
                        'offset' => 0,
                        'limit'  => 3,
                    ],
                ],
                3,
            ];
        }
        return $dataset;
    }

    /** @dataProvider parserDataSet */
    public function test_from_and_to_array(
        string $class,
        array $data,
        int $count,
        ?string $exception = null
    ): void {
        // In case of invalid data.
        if ($exception) {
            self::expectException($exception);
        }
        // Object from array
        $collection = call_user_func($class . '::fromArray', $data);
        self::assertSame($class, get_class($collection), "{$class}::fromArray(array \$json) gave an unexpected result.");

        // Array access.
        self::assertInstanceOf(Billable::class, $collection[0], 'Instance in collection does not implement DomainObjectInterface');
        self::assertTrue(isset($collection[0]), 'Cannot access property in array');
        self::assertFalse(isset($collection[3]), 'Unexpectedly, key 3 was set on collection');
        self::assertFalse(isset($collection[4]), 'Unexpectedly, key 4 was set on collection');
        $collection[3] = $collection[0];
        $collection[] = $collection[0];
        self::assertTrue(isset($collection[3]), 'Failed to set item on collection');
        self::assertTrue(isset($collection[4]), 'Failed to push item to collection');
        self::assertSame(5, count($collection));
        foreach ($collection as $item) {
            self::assertInstanceOf(Billable::class, $item, 'Instance in collection does not implement DomainObjectInterface');
        }
        unset($collection[4]);
        self::assertSame(4, count($collection), 'Failed to unset item in collection');

        // Pagination values.
        self::assertSame($count, $collection->pagination->total, 'Pagination total gave an unexpected value.');
        self::assertSame(3, $collection->pagination->limit, 'Pagination limit gave an unexpected value.');
        self::assertSame(0, $collection->pagination->offset, 'Pagination offset gave an unexpected value.');

        // To array.
        $array = $collection->toArray();
        self::assertIsArray($array, "{$class}::toArray() gave an unexpected result");
        $item = $array[0];
        self::assertIsArray($item, 'Child of collection was not transformed to array');
    }
}
