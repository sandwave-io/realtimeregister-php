<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Webmozart\Assert\Assert;

final class DsData implements DomainObjectInterface
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

    const DIGEST_TYPE_SHA1 = 1;
    const DIGEST_TYPE_SHA256 = 2;
    const DIGEST_TYPE_GOST_R_34_11_94 = 3;
    const DIGEST_TYPE_SHA384 = 4;

    /** @var int */
    public $keyTag;

    /** @var int */
    public $algorithm;

    /** @var int */
    public $digestType;

    /** @var string */
    public $digest;

    private function __construct(int $keyTag, int $algorithm, int $digestType, string $digest)
    {
        $this->keyTag = $keyTag;
        $this->algorithm = $algorithm;
        $this->digestType = $digestType;
        $this->digest = $digest;
    }

    public static function fromArray(array $json): DsData
    {
        Assert::inArray($json['algorithm'], [
            DsData::ALGORITHM_DSA_SHA1,
            DsData::ALGORITHM_RSA_SHA_1,
            DsData::ALGORITHM_DSA_NSEC3_SHA1,
            DsData::ALGORITHM_RSASHA1_NSEC3_SHA1,
            DsData::ALGORITHM_RSA_SHA_256,
            DsData::ALGORITHM_RSA_SHA_512,
            DsData::ALGORITHM_GOST_R_34_10_2001,
            DsData::ALGORITHM_ECDSA_Curve_P_256_with_SHA_256,
            DsData::ALGORITHM_ECDSA_Curve_P_384_with_SHA_384,
            DsData::ALGORITHM_Ed25519,
            DsData::ALGORITHM_Ed448,
        ]);
        Assert::inArray($json['digestType'], [
            DsData::DIGEST_TYPE_SHA1,
            DsData::DIGEST_TYPE_SHA256,
            DsData::DIGEST_TYPE_GOST_R_34_11_94,
            DsData::DIGEST_TYPE_SHA384,
        ]);
        return new DsData(
            $json['keyTag'],
            $json['algorithm'],
            $json['digestType'],
            $json['digest']
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'keyTag' => $this->keyTag,
            'algorithm' => $this->algorithm,
            'digestType' => $this->digestType,
            'digest' => $this->digest,
        ], function ($x) { return !is_null($x); });
    }
}
