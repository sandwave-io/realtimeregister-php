<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Carbon\Carbon;

final class Contact
{
    /** @var string */
    public $customer;

    /** @var string */
    public $handle;

    /** @var string|null */
    public $brand;

    /** @var string */
    public $name;

    /** @var string[] */
    public $addressLine;

    /** @var string */
    public $postalCode;

    /** @var string */
    public $city;

    /** @var string|null */
    public $state;

    /** @var string */
    public $country;

    /** @var string */
    public $email;

    /** @var string */
    public $voice;

    /** @var string|null */
    public $fax;

    /** @var string[]|null */
    public $registries;

    /** @var array<string, array<string, string>>|null */
    public $properties;

    /** @var Carbon */
    public $createdDate;

    /** @var Carbon|null */
    public $updatedDate;

    private function __construct(
        string $customer,
        string $handle,
        ?string $brand,
        string $name,
        array $addressLine,
        string $postalCode,
        string $city,
        ?string $state,
        string $country,
        string $email,
        string $voice,
        ?string $fax,
        ?array $registries,
        ?array $properties,
        Carbon $createdDate,
        ?Carbon $updatedDate
    ) {
        $this->customer = $customer;
        $this->handle = $handle;
        $this->brand = $brand;
        $this->name = $name;
        $this->addressLine = $addressLine;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->email = $email;
        $this->voice = $voice;
        $this->fax = $fax;
        $this->registries = $registries;
        $this->properties = $properties;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
    }

    public static function fromArray(array $data): Contact
    {
        $updatedDate = $data['updatedDate'] ? new Carbon($data['updatedDate']) : null;
        return new Contact(
            $data['customer'],
            $data['handle'],
            $data['brand'],
            $data['name'],
            $data['addressLine'],
            $data['postalCode'],
            $data['city'],
            $data['state'],
            $data['country'],
            $data['email'],
            $data['voice'],
            $data['fax'],
            $data['registries'],
            $data['properties'],
            new Carbon($data['createdDate']),
            $updatedDate
        );
    }
}