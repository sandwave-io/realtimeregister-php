<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class KeyDataAlgorithmEnum extends AbstractEnum
{
    const ALGORITHM_DSA_SHA1 = 3;
    const ALGORITHM_RSA_SHA_1 = 5;
    const ALGORITHM_DSA_NSEC3_SHA1 = 6;
    const ALGORITHM_RSASHA1_NSEC3_SHA1 = 7;
    const ALGORITHM_RSA_SHA_256 = 8;
    const ALGORITHM_RSA_SHA_512 = 10;
    const ALGORITHM_GOST_R_34_10_2001 = 12;
    const ALGORITHM_ECDSA_Curve_P_256_with_SHA_256 = 13;
    const ALGORITHM_ECDSA_Curve_P_384_with_SHA_384 = 14;
    const ALGORITHM_Ed25519 = 15;
    const ALGORITHM_Ed448 = 16;

    protected static $values = [
        KeyDataAlgorithmEnum::ALGORITHM_DSA_SHA1,
        KeyDataAlgorithmEnum::ALGORITHM_RSA_SHA_1,
        KeyDataAlgorithmEnum::ALGORITHM_DSA_NSEC3_SHA1,
        KeyDataAlgorithmEnum::ALGORITHM_RSASHA1_NSEC3_SHA1,
        KeyDataAlgorithmEnum::ALGORITHM_RSA_SHA_256,
        KeyDataAlgorithmEnum::ALGORITHM_RSA_SHA_512,
        KeyDataAlgorithmEnum::ALGORITHM_GOST_R_34_10_2001,
        KeyDataAlgorithmEnum::ALGORITHM_ECDSA_Curve_P_256_with_SHA_256,
        KeyDataAlgorithmEnum::ALGORITHM_ECDSA_Curve_P_384_with_SHA_384,
        KeyDataAlgorithmEnum::ALGORITHM_Ed25519,
        KeyDataAlgorithmEnum::ALGORITHM_Ed448,
    ];

    /** @param int $value */
    public static function validate($value): void
    {
        KeyDataAlgorithmEnum::assertValueValid($value);
    }
}
