<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\DcvTypeEnum;

class ResendDcv implements DomainObjectInterface
{
    public function __construct(
        public readonly string $commonName,
        public readonly string $type,
        public readonly ?string $email,
    ) {
    }

    public function toArray(): array
    {
        return array_filter(
            [
            'commonName' => $this->commonName,
            'type' => $this->type,
            'email' => $this->email,
        ],
            fn ($value) => ! is_null($value)
        );
    }

    public static function fromArray(array $json): ResendDcv
    {
        DcvTypeEnum::validate($json['type']);

        return new ResendDcv(
            $json['commonName'],
            $json['type'],
            $json['email'] ?? null
        );
    }
}
