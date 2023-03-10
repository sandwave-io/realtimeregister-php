<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\KeyDataAlgorithmEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\KeyDataFlagEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\KeyDataProtocolEnum;
use SandwaveIo\RealtimeRegister\Exceptions\InvalidArgumentException;

final class KeyData implements DomainObjectInterface
{
    public int $protocol;

    public int $flags;

    public int $algorithm;

    public string $publicKey;

    private function __construct(int $protocol, int $flags, int $algorithm, string $publicKey)
    {
        $this->protocol = $protocol;
        $this->flags = $flags;
        $this->algorithm = $algorithm;
        $this->publicKey = $publicKey;
    }

    public static function fromArray(array $json): KeyData
    {
        KeyDataProtocolEnum::validate($json['protocol']);
        KeyDataFlagEnum::validate($json['flags']);
        KeyDataAlgorithmEnum::validate($json['algorithm']);

        $decodedKey = base64_decode($json['publicKey']);

        if (base64_encode($decodedKey) !== $json['publicKey']) {
            throw new InvalidArgumentException('Key is not base64 encoded.');
        }

        return new KeyData(
            $json['protocol'],
            $json['flags'],
            $json['algorithm'],
            $json['publicKey']
        );
    }

    public function toArray(): array
    {
        return [
            'protocol' => $this->protocol,
            'flags' => $this->flags,
            'algorithm' => $this->algorithm,
            'publicKey' => $this->publicKey,
        ];
    }
}
