<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain\Enum;

class DocsEnum extends AbstractEnum
{
    const DOCS_WAITING = 'WAITING';
    const DOCS_ATTENTION = 'ATTENTION';

    const DOCS_VALIDATED = 'VALIDATED';

    protected static array $values = [
        self::DOCS_WAITING,
        self::DOCS_ATTENTION,
        self::DOCS_VALIDATED,
    ];

    /** @param string $value */
    public static function validate($value): void
    {
        self::assertValueValid($value);
    }
}
