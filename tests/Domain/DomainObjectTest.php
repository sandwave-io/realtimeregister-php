<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Domain;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Account;
use SandwaveIo\RealtimeRegister\Domain\Billable;
use InvalidArgumentException;
use SandwaveIo\RealtimeRegister\Domain\Contact;
use SandwaveIo\RealtimeRegister\Domain\Country;
use SandwaveIo\RealtimeRegister\Domain\DomainAvailability;
use TypeError;

/**
 * This TestCase is used to test all single Domain Objects.
 * If you want to test Collections, use the DomainCollectionTest instead.
 */
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
            'valid account' => [
                Account::class,
                include __DIR__.'/data/account_valid.php',
            ],
            'invalid account (balance)' => [
                Account::class,
                include __DIR__.'/data/account_invalid_balance.php',
                TypeError::class
            ],

            'valid billable' => [
                Billable::class,
                include __DIR__.'/data/billable_valid.php',
            ],
            'invalid billable (action)' => [
                Billable::class,
                include __DIR__.'/data/billable_invalid_action.php',
                InvalidArgumentException::class
            ],

            'valid contact (all fields)' => [
                Contact::class,
                include __DIR__.'/data/contact_valid.php',
            ],
            'valid contact (only required fields)' => [
                Contact::class,
                include __DIR__.'/data/contact_valid_only_required.php',
            ],
            'invalid contact (name)' => [
                Contact::class,
                include __DIR__.'/data/contact_invalid_name.php',
                TypeError::class,
            ],

            'valid country (all fields)' => [
                Country::class,
                include __DIR__.'/data/country_valid.php',
            ],
            'valid country (only required fields)' => [
                Country::class,
                include __DIR__.'/data/country_valid_only_required.php',
            ],
            'invalid country (name)' => [
                Country::class,
                include __DIR__.'/data/country_invalid_code.php',
                TypeError::class,
            ],

            'valid domain availability (all fields)' => [
                DomainAvailability::class,
                include __DIR__.'/data/domain_availability_valid.php',
            ],
            'invalid domain availability (name)' => [
                DomainAvailability::class,
                include __DIR__.'/data/domain_availability_invalid_price.php',
                TypeError::class,
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
