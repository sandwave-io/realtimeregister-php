<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class ContactsConstraint implements DomainObjectInterface
{
    public int $min;

    public int $max;

    public bool $required;

    public bool $organizationRequired;

    public bool $organizationAllowed;

    /** @var array<string>|null */
    public ?array $allowedCountries;

    private function __construct(int $min, int $max, bool $required, bool $organizationRequired, bool $organizationAllowed, ?array $allowedCountries)
    {
        $this->min = $min;
        $this->max = $max;
        $this->required = $required;
        $this->organizationRequired = $organizationRequired;
        $this->organizationAllowed = $organizationAllowed;
        $this->allowedCountries = $allowedCountries;
    }

    public static function fromArray(array $json): ContactsConstraint
    {
        return new ContactsConstraint(
            $json['min'],
            $json['max'],
            $json['required'],
            $json['organizationRequired'],
            $json['organizationAllowed'],
            $json['allowedCountries'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'min' => $this->min,
            'max' => $this->max,
            'required' => $this->required,
            'organizationRequired' => $this->organizationRequired,
            'organizationAllowed' => $this->organizationAllowed,
            'allowedCountries' => $this->allowedCountries,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
