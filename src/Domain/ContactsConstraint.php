<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class ContactsConstraint implements DomainObjectInterface
{
    /** @var int */
    public $min;

    /** @var int */
    public $max;

    /** @var bool */
    public $required;

    /** @var bool */
    public $organizationRequired;

    /** @var bool */
    public $organizationAllowed;

    /** @var array<string>|null */
    public $allowedCountries;

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
            'min' =>$this->min,
            'max' =>$this->max,
            'required' =>$this->required,
            'organizationRequired' =>$this->organizationRequired,
            'organizationAllowed' =>$this->organizationAllowed,
            'allowedCountries' =>$this->allowedCountries,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
