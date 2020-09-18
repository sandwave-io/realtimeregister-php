<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\DsDataAlgorithmEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\DsDataDigestTypeEnum;

final class DsData implements DomainObjectInterface
{
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
        DsDataAlgorithmEnum::validate($json['algorithm']);
        DsDataDigestTypeEnum::validate($json['digestType']);

        return new DsData(
            $json['keyTag'],
            $json['algorithm'],
            $json['digestType'],
            $json['digest']
        );
    }

    public function toArray(): array
    {
        return [
            'keyTag' => $this->keyTag,
            'algorithm' => $this->algorithm,
            'digestType' => $this->digestType,
            'digest' => $this->digest,
        ];
    }
}
