<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Domain;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\AccountCollection;
use SandwaveIo\RealtimeRegister\Domain\BillableCollection;
use SandwaveIo\RealtimeRegister\Domain\ContactCollection;
use SandwaveIo\RealtimeRegister\Domain\ContactPropertyCollection;
use SandwaveIo\RealtimeRegister\Domain\CountryCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainAvailabilityCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainContactCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainDetailsCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainObjectInterface;
use SandwaveIo\RealtimeRegister\Domain\DsDataCollection;
use SandwaveIo\RealtimeRegister\Domain\KeyDataCollection;
use SandwaveIo\RealtimeRegister\Domain\LaunchPhaseCollection;
use SandwaveIo\RealtimeRegister\Domain\LogCollection;
use SandwaveIo\RealtimeRegister\Domain\NotificationCollection;
use SandwaveIo\RealtimeRegister\Domain\NotificationPollCollection;
use SandwaveIo\RealtimeRegister\Domain\PriceCollection;

/**
 * This TestCase is used to test all Domain Object Collections.
 * If you want to test Domain Objects, use the DomainObjectTest instead.
 */
class DomainCollectionTest extends TestCase
{
    public function parserDataSet(): array
    {
        /**
         * A flat and a pagination is generated for each scenario.
         * The arguments:
         *  - Class
         *  - Entity data.
         */
        $scenarios = [
            'account collection' => [AccountCollection::class, include __DIR__ . '/data/account_valid.php'],
            'billable collection' => [BillableCollection::class, include __DIR__ . '/data/billable_valid.php'],
            'country collection' => [CountryCollection::class, include __DIR__ . '/data/country_valid.php'],
            'contact collection' => [ContactCollection::class, include __DIR__ . '/data/contact_valid.php'],
            'domain availability collection' => [DomainAvailabilityCollection::class, include __DIR__ . '/data/domain_availability_valid.php'],
            'domain contact collection' => [DomainContactCollection::class, include __DIR__ . '/data/domain_contact_valid.php'],
            'domain details collection' => [DomainDetailsCollection::class, include __DIR__ . '/data/domain_details_valid.php'],
            'ds data collection' => [DsDataCollection::class, include __DIR__ . '/data/ds_data_valid.php'],
            'key data collection' => [KeyDataCollection::class, include __DIR__ . '/data/key_data_valid.php'],
            'price collection' => [PriceCollection::class, include __DIR__ . '/data/price_valid.php'],
            'contact property collection' => [ContactPropertyCollection::class, include __DIR__ . '/data/contact_property_valid.php'],
            'launch phase collection' => [LaunchPhaseCollection::class, include __DIR__ . '/data/launch_phase.php'],
            'log collection' => [LogCollection::class, include __DIR__ . '/data/log.php'],
            'notification collection' => [NotificationCollection::class, include __DIR__ . '/data/notification_valid.php'],
            'notification poll collection' => [NotificationPollCollection::class, include __DIR__ . '/data/notification_poll_valid.php'],
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
    public function test_from_and_to_array(string $class, array $data, int $count, ?string $exception = null): void
    {
        // In case of invalid data.
        if ($exception) {
            $this->expectException($exception);
        }
        // Object from array
        $collection = call_user_func($class . '::fromArray', $data);
        $this->assertSame($class, get_class($collection), "{$class}::fromArray(array \$json) gave an unexpected result.");

        // Array access.
        $this->assertInstanceOf(DomainObjectInterface::class, $collection[0], 'Instance in collection does not implement DomainObjectInterface');
        $this->assertTrue(isset($collection[0]), 'Cannot access property in array');
        $this->assertFalse(isset($collection[3]), 'Unexpectedly, key 3 was set on collection');
        $this->assertFalse(isset($collection[4]), 'Unexpectedly, key 4 was set on collection');
        $collection[3] = $collection[0];
        $collection[] = $collection[0];
        $this->assertTrue(isset($collection[3]), 'Failed to set item on collection');
        $this->assertTrue(isset($collection[4]), 'Failed to push item to collection');
        $this->assertSame(5, count($collection));
        foreach ($collection as $item) {
            $this->assertInstanceOf(DomainObjectInterface::class, $item, 'Instance in collection does not implement DomainObjectInterface');
        }
        unset($collection[4]);
        $this->assertSame(4, count($collection), 'Failed to unset item in collection');

        // Pagination values.
        $this->assertSame($count, $collection->pagination->total, 'Pagination total gave an unexpected value.');
        $this->assertSame(3, $collection->pagination->limit, 'Pagination limit gave an unexpected value.');
        $this->assertSame(0, $collection->pagination->offset, 'Pagination offset gave an unexpected value.');

        // To array.
        $array = $collection->toArray();
        $this->assertIsArray($array, "{$class}::toArray() gave an unexpected result");
        $item = $array[0];
        $this->assertIsArray($item, 'Child of collection was not transformed to array');
    }
}
