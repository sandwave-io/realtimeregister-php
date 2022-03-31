<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class PublicKeyAlgorithmEnum extends AbstractEnum
{
    const PUBLIC_KEY_ALGORITHM_RSA = 'RSA';
    const PUBLIC_KEY_ALGORITHM_ECDSA = 'ECDSA';

    protected static array $values = [
        PublicKeyAlgorithmEnum::PUBLIC_KEY_ALGORITHM_RSA,
        PublicKeyAlgorithmEnum::PUBLIC_KEY_ALGORITHM_ECDSA,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        PublicKeyAlgorithmEnum::assertValueValid($value);
    }
}
