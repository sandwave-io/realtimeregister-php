<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class Registrant implements DomainObjectInterface
{
    /** @var bool */
    public $organizationRequired;

    /** @var bool */
    public $organizationAllowed;

    /** @var array<string>|null */
    public $allowedCountries;

    private function __construct(bool $organizationRequired, bool $organizationAllowed, ?array $allowedCountries)
    {
        $this->organizationRequired = $organizationRequired;
        $this->organizationAllowed = $organizationAllowed;
        $this->allowedCountries = $allowedCountries;
    }

    public static function fromArray(array $json): Registrant
    {
        return new Registrant(
            $json['organizationRequired'],
            $json['organizationAllowed'],
            $json['allowedCountries'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'organizationRequired' =>$this->organizationRequired,
            'organizationAllowed' =>$this->organizationAllowed,
            'allowedCountries' =>$this->allowedCountries,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
