<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use InvalidArgumentException;
use SandwaveIo\RealtimeRegister\Domain\Contact;
use SandwaveIo\RealtimeRegister\Domain\ContactCollection;
use SandwaveIo\RealtimeRegister\Domain\Country;
use SandwaveIo\RealtimeRegister\Domain\CountryCollection;

final class ContactsApi extends AbstractApi
{
    /* @see https://dm.realtimeregister.com/docs/api/contacts/list */
    public function list(string $customer, ?int $limit = null, ?int $offset = null, ?string $search = null): ContactCollection
    {
        $query = [];
        if (! is_null($limit)) {
            $query['limit'] = $limit;
        }
        if (! is_null($offset)) {
            $query['offset'] = $offset;
        }
        if (! is_null($search)) {
            $query['q'] = $search;
        }

        $response = $this->client->get("v2/customers/{$customer}/contacts", $query);
        return ContactCollection::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/contacts/get */
    public function get(string $customer, string $handle): Contact
    {
        $response = $this->client->get("v2/customers/{$customer}/contacts/{$handle}");
        return Contact::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/contacts/create
     *
     * @param string[] $addressLine
     */
    public function create(
        string $customer,
        string $handle,
        string $name,
        array $addressLine,
        string $postalCode,
        string $city,
        string $country,
        string $email,
        string $voice,
        ?string $brand = null,
        ?string $organization = null,
        ?string $state = null,
        ?string $fax = null
    ): void {
        $payload = [
            'customer' => $customer,
            'handle' => $handle,
            'name' => $name,
            'addressLine' => $addressLine,
            'postalCode' => $postalCode,
            'city' => $city,
            'country' => $country,
            'email' => $email,
            'voice' => $voice,
        ];
        if ($brand) {
            $payload['brand'] = $brand;
        }
        if ($organization) {
            $payload['organization'] = $organization;
        }
        if ($state) {
            $payload['state'] = $state;
        }
        if ($fax) {
            $payload['fax'] = $fax;
        }

        $this->client->post("v2/customers/{$customer}/contacts/$handle", $payload);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/contacts/create
     *
     * @param string[] $addressLine
     */
    public function update(
        string $customer,
        string $handle,
        ?string $name = null,
        ?array $addressLine = null,
        ?string $postalCode = null,
        ?string $city = null,
        ?string $country = null,
        ?string $email = null,
        ?string $voice = null,
        ?string $brand = null,
        ?string $organization = null,
        ?string $state = null,
        ?string $fax = null
    ): void {
        $payload = [
            'customer' => $customer,
            'handle' => $handle,
        ];

        if ($name) {
            $payload['name'] = $name;
        }
        if ($addressLine) {
            $payload['addressLine'] = $addressLine;
        }
        if ($postalCode) {
            $payload['postalCode'] = $postalCode;
        }
        if ($city) {
            $payload['city'] = $city;
        }
        if ($country) {
            $payload['country'] = $country;
        }
        if ($email) {
            $payload['email'] = $email;
        }
        if ($voice) {
            $payload['voice'] = $voice;
        }
        if ($brand) {
            $payload['brand'] = $brand;
        }
        if ($organization) {
            $payload['organization'] = $organization;
        }
        if ($state) {
            $payload['state'] = $state;
        }
        if ($fax) {
            $payload['fax'] = $fax;
        }

        $this->client->post("v2/customers/{$customer}/contacts/{$handle}/update", $payload);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/contacts/validate
     *
     * @param array<string> $categories Must be one of ("General", "IisNu", "IisSe", "Nominet", "DkHostmaster")
     */
    public function validate(string $customer, string $handle, array $categories): void
    {
        foreach ($categories as $category) {
            $categoriesAllowed = ['General', 'IisNu', 'IisSe', 'Nominet', 'DkHostmaster'];

            if (! in_array($category, $categoriesAllowed)) {
                $imploded = implode(',', $categoriesAllowed);
                throw new InvalidArgumentException("Provided Category not in array: {$category} Valid options: {$imploded}");
            }
        }

        $this->client->post("v2/customers/{$customer}/contacts/{$handle}/validate", [
            'categories' => $categories,
        ]);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/contacts/split
     *
     * @param array<string>|null $registries
     */
    public function split(string $customer, string $handle, string $newHandle, ?array $registries = null): void
    {
        $payload = ['newHandle' => $newHandle];

        if ($registries) {
            $payload['registries'] = $registries;
        }

        $this->client->post("v2/customers/{$customer}/contacts/{$handle}/split", $payload);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/contacts/delete
     */
    public function delete(string $customer, string $handle): void
    {
        $this->client->delete("v2/customers/{$customer}/contacts/{$handle}");
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/contacts/properties/add
     *
     * @param array<string, string> $properties
     * @param string|null           $intendedUsage Must be one of ("REGISTRANT","ADMIN","BILLING","TECH").
     */
    public function addProperties(string $customer, string $handle, string $registry, array $properties, ?string $intendedUsage = null): void
    {
        $payload = ['properties' => $properties];
        if ($intendedUsage) {
            $usages = ['REGISTRANT', 'ADMIN', 'BILLING', 'TECH'];

            if (! in_array($intendedUsage, $usages)) {
                $imploded = implode(',', $usages);
                throw new InvalidArgumentException("Provided Category not in array: {$intendedUsage} Valid options: {$imploded}");
            }

            $payload['intendedUsage'] = $intendedUsage;
        }
        $this->client->post("v2/customers/{$customer}/contacts/{$handle}/{$registry}", $payload);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/contacts/properties/update
     *
     * @param array<string, string> $properties
     */
    public function updateProperties(string $customer, string $handle, string $registry, array $properties): void
    {
        $this->client->post("v2/customers/{$customer}/contacts/{$handle}/{$registry}/update", [
            'properties' => $properties,
        ]);
    }

    /* @see https://dm.realtimeregister.com/docs/api/countries/get */
    public function getCountry(string $country): Country
    {
        return Country::fromArray($this->client->get("v2/countries/{$country}")->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/contacts/list */
    public function listCountries(?int $limit = null, ?int $offset = null, ?string $search = null): CountryCollection
    {
        $query = [];
        if (! is_null($limit)) {
            $query['limit'] = $limit;
        }
        if (! is_null($offset)) {
            $query['offset'] = $offset;
        }
        if (! is_null($search)) {
            $query['q'] = $search;
        }

        $response = $this->client->get('v2/countries', $query);
        return CountryCollection::fromArray($response->json());
    }
}
