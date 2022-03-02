<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use ArrayAccess;
use Countable;

final class LanguageCodes implements ArrayAccess, Countable
{
    /** @var array<string, LanguageCode> */
    public array $entities;

    private function __construct(array $entities)
    {
        $this->entities = $entities;
    }

    public static function fromArray(array $json): self
    {
        $entities = [];

        foreach ($json as $countryCode => $languageCode) {
            $entities[$countryCode] = LanguageCode::fromArray($languageCode);
        }

        return new self($entities);
    }

    public function toArray(): array
    {
        $languageCodesArray = [];

        foreach ($this->entities as $countryCode => $languageCode) {
            $languageCodesArray[$countryCode] = $languageCode->toArray();
        }

        return $languageCodesArray;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->entities[$offset]);
    }

    public function offsetGet($offset): ?LanguageCode
    {
        return $this->entities[$offset] ?? null;
    }

    public function offsetSet($offset, $value): void
    {
        if (is_string($offset) && $value instanceof LanguageCode) {
            $this->entities[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->entities[$offset]);
    }

    public function count(): int
    {
        return count($this->entities);
    }
}
