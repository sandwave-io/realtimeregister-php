<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;

final class Contact implements DomainObjectInterface
{
    /** @var string */
    public $customer;

    /** @var string */
    public $handle;

    /** @var string */
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
    public $organization;

    /** @var string|null */
    public $fax;

    /** @var string[]|null */
    public $registries;

    /** @var array<string, array<string, string>>|null */
    public $properties;

    /** @var DateTime */
    public $createdDate;

    /** @var DateTime|null */
    public $updatedDate;

    private function __construct(
        string $customer,
        string $handle,
        string $brand,
        ?string $organization,
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
        DateTime $createdDate,
        ?DateTime $updatedDate
    ) {
        $this->customer = $customer;
        $this->handle = $handle;
        $this->brand = $brand;
        $this->organization = $organization;
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
        $updatedDate = isset($data['updatedDate']) ? new DateTime($data['updatedDate']) : null;
        return new Contact(
            $data['customer'],
            $data['handle'],
            $data['brand'],
            $data['organization'] ?? null,
            $data['name'],
            $data['addressLine'],
            $data['postalCode'],
            $data['city'],
            $data['state'] ?? null,
            $data['country'],
            $data['email'],
            $data['voice'],
            $data['fax'] ?? null,
            $data['registries'] ?? null,
            $data['properties'] ?? null,
            new DateTime($data['createdDate']),
            $updatedDate
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'customer' =>$this->customer,
            'handle' =>$this->handle,
            'brand' =>$this->brand,
            'organization' =>$this->organization,
            'name' =>$this->name,
            'addressLine' =>$this->addressLine,
            'postalCode' =>$this->postalCode,
            'city' =>$this->city,
            'state' =>$this->state,
            'country' =>$this->country,
            'email' =>$this->email,
            'voice' =>$this->voice,
            'fax' =>$this->fax,
            'registries' =>$this->registries,
            'properties' =>$this->properties,
            'createdDate' =>$this->createdDate->format('Y-m-d H:i:s'),
            'updatedDate' =>$this->updatedDate ? $this->updatedDate->format('Y-m-d H:i:s') : null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
