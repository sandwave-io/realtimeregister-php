<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;

final class Contact implements DomainObjectInterface
{
    public string $customer;
    public string $handle;
    public string $brand;
    public string $name;
    /** @var string[] */
    public array $addressLine;
    public string $postalCode;
    public string $city;
    public ?string $state;
    public string $country;
    public string $email;
    public string $voice;
    public ?string $organization;
    public ?string $fax;
    /** @var string[]|null */
    public ?array $registries;
    /** @var array<string, array<string, string>>|null */
    public ?array $properties;
    public Datetime $createdDate;
    public ?Datetime $updatedDate;

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
