<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class DownloadFormatEnum extends AbstractEnum
{
    const CRT_FORMAT = 'CRT';
    const CA_FORMAT = 'CA';
    const CA_BUNDLE_FORMAT = 'CA_BUNDLE';

    protected static array $values = [
        DownloadFormatEnum::CRT_FORMAT,
        DownloadFormatEnum::CA_FORMAT,
        DownloadFormatEnum::CA_BUNDLE_FORMAT,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        DownloadFormatEnum::assertValueValid($value);
    }
}
