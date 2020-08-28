<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Webmozart\Assert\Assert;

final class KeyData
{
    const FLAG_ZSK = 256;
    const FLAG_KSK = 257;

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

    /** @var int */
    public $protocol;

    /** @var int */
    public $flags;

    /** @var int */
    public $algorithm;

    /** @var string */
    public $publicKey;

    private function __construct(int $protocol, int $flags, int $algorithm, string $publicKey)
    {
        $this->protocol = $protocol;
        $this->flags = $flags;
        $this->algorithm = $algorithm;
        $this->publicKey = $publicKey;
    }

    public static function fromArray(array $json): KeyData
    {
        Assert::eq($json['protocol'], 3);
        Assert::inArray($json['flags'], [
            KeyData::FLAG_ZSK,
            KeyData::FLAG_KSK,
        ]);
        Assert::inArray($json['algorithm'], [
            KeyData::ALGORITHM_DSA_SHA1,
            KeyData::ALGORITHM_RSA_SHA_1,
            KeyData::ALGORITHM_DSA_NSEC3_SHA1,
            KeyData::ALGORITHM_RSASHA1_NSEC3_SHA1,
            KeyData::ALGORITHM_RSA_SHA_256,
            KeyData::ALGORITHM_RSA_SHA_512,
            KeyData::ALGORITHM_GOST_R_34_10_2001,
            KeyData::ALGORITHM_ECDSA_Curve_P_256_with_SHA_256,
            KeyData::ALGORITHM_ECDSA_Curve_P_384_with_SHA_384,
            KeyData::ALGORITHM_Ed25519,
            KeyData::ALGORITHM_Ed448,
        ]);
        return new KeyData(
            $json['protocol'],
            $json['flags'],
            $json['algorithm'],
            $json['publicKey']
        );
    }
}
