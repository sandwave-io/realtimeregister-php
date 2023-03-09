<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Domain;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\DnsTemplate;

class DnsTemplateObjectTest extends TestCase
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
            'valid dnstemplate with records' => [
                DnsTemplate::class,
                include __DIR__ . '/data/dnstemplate_valid_with_records.php',
            ],
            'valid dnstemplate without records' => [
                DnsTemplate::class,
                include __DIR__ . '/data/dnstemplate_valid_without_records.php',
            ],
        ];
    }

    /** @dataProvider parserDataSet */
    public function test_from_and_to_array(string $class, array $data): void
    {
        // Object from array
        $object = call_user_func($class . '::fromArray', $data);
        $this->assertSame($class, get_class($object), "{$class}::fromArray(array \$json) gave an unexpected result.");

        // Object to array
        $array = $object->toArray();
        $this->assertSame($data, $array, "{$class}::toArray() gave an unexpected result.");
    }
}
