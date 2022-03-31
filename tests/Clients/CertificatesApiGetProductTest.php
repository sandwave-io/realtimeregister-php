<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Clients;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Enum\CertificateTypeEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\FeatureEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\ValidationTypeEnum;
use SandwaveIo\RealtimeRegister\Tests\Helpers\MockedClientFactory;

class CertificatesApiGetProductTest extends TestCase
{
    public function test_get(): void
    {
        $sdk = MockedClientFactory::makeSdk(
            200,
            json_encode([
                'product' => 'ssl',
                'brand' => 'brand',
                'name' => 'SSL',
                'validationType' => ValidationTypeEnum::VALIDATION_TYPE_DOMAIN_VALIDATION,
                'certificateType' => CertificateTypeEnum::LOCALE_MULTI_DOMAIN,
                'features' => [FeatureEnum::FEATURE_WILDCARD],
                'requiredFields' => ['dcv', 'address', 'postalCode'],
                'optionalFields' => ['organization'],
                'periods' => [1, 3, 6, 12],
                'warranty' => 50000,
                'issueTime' => '15-30 minutes',
                'renewalWindow' => 14,
                'includedDomains' => 5,
                'maxDomains' => 25,
            ]),
            MockedClientFactory::assertRoute('GET', '/v2/ssl/products/ssl', $this)
        );

        $product = $sdk->certificates->getProduct('ssl');

        self::assertSame('ssl', $product->product);
        self::assertSame('brand', $product->brand);
        self::assertSame('SSL', $product->name);
        self::assertSame(ValidationTypeEnum::VALIDATION_TYPE_DOMAIN_VALIDATION, $product->validationType);
        self::assertSame(CertificateTypeEnum::LOCALE_MULTI_DOMAIN, $product->certificateType);
        self::assertSame([FeatureEnum::FEATURE_WILDCARD], $product->features);
        self::assertSame(['dcv', 'address', 'postalCode'], $product->requiredFields);
        self::assertSame(['organization'], $product->optionalFields);
        self::assertSame([1, 3, 6, 12], $product->periods);
        self::assertSame(50000, $product->warranty);
        self::assertSame('15-30 minutes', $product->issueTime);
        self::assertSame(14, $product->renewalWindow);
        self::assertSame(5, $product->includedDomains);
        self::assertSame(25, $product->maxDomains);
    }
}
