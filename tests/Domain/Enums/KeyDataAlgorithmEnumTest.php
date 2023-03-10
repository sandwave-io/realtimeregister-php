<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Domain\Enums;

use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Enum\KeyDataAlgorithmEnum;
use SandwaveIo\RealtimeRegister\Exceptions\InvalidArgumentException;

class KeyDataAlgorithmEnumTest extends TestCase
{
    public static function data(): array
    {
        return [
            ['DSA', KeyDataAlgorithmEnum::ALGORITHM_DSA_SHA1],
            ['RSASHA1', KeyDataAlgorithmEnum::ALGORITHM_RSA_SHA_1],
            ['DSA-NSEC3-SHA1', KeyDataAlgorithmEnum::ALGORITHM_DSA_NSEC3_SHA1],
            ['RSASHA1-NSEC3-SHA1', KeyDataAlgorithmEnum::ALGORITHM_RSASHA1_NSEC3_SHA1],
            ['RSASHA256', KeyDataAlgorithmEnum::ALGORITHM_RSA_SHA_256],
            ['RSASHA512', KeyDataAlgorithmEnum::ALGORITHM_RSA_SHA_512],
            ['ECC-GOST', KeyDataAlgorithmEnum::ALGORITHM_GOST_R_34_10_2001],
            ['ECDSAP256SHA256', KeyDataAlgorithmEnum::ALGORITHM_ECDSA_Curve_P_256_with_SHA_256],
            ['ECDSAP384SHA384', KeyDataAlgorithmEnum::ALGORITHM_ECDSA_Curve_P_384_with_SHA_384],
            ['ED25519', KeyDataAlgorithmEnum::ALGORITHM_Ed25519],
            ['ED448', KeyDataAlgorithmEnum::ALGORITHM_Ed448],
        ];
    }

    /** @dataProvider data */
    public function test_from_mnemonic($name, $algorithm): void
    {
        self::assertSame($algorithm, KeyDataAlgorithmEnum::fromMnemonic($name));
    }

    public function test_from_mnemonic_error(): void
    {
        self::expectException(InvalidArgumentException::class);
        KeyDataAlgorithmEnum::fromMnemonic('My special algorithm that is not supported!');
    }
}
