<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class LanguageCode implements DomainObjectInterface
{
    public string $name;
    public ?string $allowedCharacters;

    private function __construct(string $name, ?string $allowedCharacters)
    {
        $this->name = $name;
        $this->allowedCharacters = $allowedCharacters;
    }

    public static function fromArray(array $json): LanguageCode
    {
        return new LanguageCode(
            $json['name'],
            $json['allowedCharacters'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name'              => $this->name,
            'allowedCharacters' => $this->allowedCharacters,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
