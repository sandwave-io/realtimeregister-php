<?php declare(strict_types=1);

namespace SandwaveIo\RealtimeRegister\Tests\Domain;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\LanguageCode;
use SandwaveIo\RealtimeRegister\Domain\LanguageCodes;

final class LanguageCodesTest extends TestCase
{
    public function test_from_array(): void
    {
        $languageCodeData = include __DIR__ . '/data/language_codes.php';

        $languageCodes = LanguageCodes::fromArray($languageCodeData);

        Assert::assertCount(2, $languageCodes);

        $languageCodeDutch = $languageCodes->offsetGet('DUT');

        assert($languageCodeDutch !== null);

        Assert::assertInstanceOf(LanguageCode::class, $languageCodeDutch);
        Assert::assertSame('Dutch', $languageCodeDutch->name);
        Assert::assertSame('abcdefghijklmnopqrstuvwxyz', $languageCodeDutch->allowedCharacters);

        $languageCodeEnglish = $languageCodes->offsetGet('ENG');

        assert($languageCodeEnglish !== null);

        Assert::assertInstanceOf(LanguageCode::class, $languageCodeEnglish);
        Assert::assertSame('English', $languageCodeEnglish->name);
        Assert::assertNull($languageCodeEnglish->allowedCharacters);

    }

    public function test_from_and_to_array(): void
    {
        $languageCodeData = include __DIR__ . '/data/language_codes.php';

        $languageCodes = LanguageCodes::fromArray($languageCodeData);

        Assert::assertSame($languageCodeData, $languageCodes->toArray());
    }
}
