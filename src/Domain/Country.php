<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class Country implements DomainObjectInterface
{
    /** @var string */
    public $code;

    /** @var string */
    public $name;

    /** @var string|null */
    public $postalCodePattern;

    /** @var string|null */
    public $postalCodeExample;

    private function __construct(string $code, string $name, ?string $postalCodePattern = null, ?string $postalCodeExample = null)
    {
        $this->code = $code;
        $this->name = $name;
        $this->postalCodePattern = $postalCodePattern;
        $this->postalCodeExample = $postalCodeExample;
    }

    public static function fromArray(array $json): Country
    {
        return new Country(
            $json['code'],
            $json['name'],
            $json['postalCodePattern'] ?? null,
            $json['postalCodeExample'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'code' =>$this->code,
            'name' =>$this->name,
            'postalCodePattern' =>$this->postalCodePattern,
            'postalCodeExample' =>$this->postalCodeExample,
        ];
    }
}
