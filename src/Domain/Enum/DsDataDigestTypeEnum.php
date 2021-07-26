<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class DsDataDigestTypeEnum extends AbstractEnum
{
    const DIGEST_TYPE_SHA1 = 1;
    const DIGEST_TYPE_SHA256 = 2;
    const DIGEST_TYPE_GOST_R_34_11_94 = 3;
    const DIGEST_TYPE_SHA384 = 4;

    protected static array $values = [
        DsDataDigestTypeEnum::DIGEST_TYPE_SHA1,
        DsDataDigestTypeEnum::DIGEST_TYPE_SHA256,
        DsDataDigestTypeEnum::DIGEST_TYPE_GOST_R_34_11_94,
        DsDataDigestTypeEnum::DIGEST_TYPE_SHA384,
    ];

    /** @param int $value */
    public static function validate($value): void
    {
        DsDataDigestTypeEnum::assertValueValid($value);
    }
}
