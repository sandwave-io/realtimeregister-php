<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use DateTime;
use SandwaveIo\RealtimeRegister\Domain\Enum\LocaleEnum;

final class Brand implements DomainObjectInterface
{
    public string $customer;
    public string $handle;
    public string $locale;
    public string $organization;
    /** @var string[] */
    public array $addressLine;
    public string $postalCode;
    public string $city;
    public ?string $state;
    public string $country;
    public string $email;
    public ?string $url;
    public string $voice;
    public ?string $fax;
    public ?string $privacyContact;
    public ?string $abuseContact;
    public DateTime $createdDate;
    public ?DateTime $updatedDate;

    private function __construct(
        string $customer,
        string $handle,
        string $locale,
        string $organization,
        array $addressLine,
        string $postalCode,
        string $city,
        ?string $state,
        string $country,
        string $email,
        ?string $url,
        string $voice,
        ?string $fax,
        ?string $privacyContact,
        ?string $abuseContact,
        DateTime $createdDate,
        ?DateTime $updatedDate
    ) {
        $this->customer = $customer;
        $this->handle = $handle;
        $this->locale = $locale;
        $this->organization = $organization;
        $this->addressLine = $addressLine;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->email = $email;
        $this->url = $url;
        $this->voice = $voice;
        $this->fax = $fax;
        $this->privacyContact = $privacyContact;
        $this->abuseContact = $abuseContact;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
    }

    public static function fromArray(array $json): Brand
    {
        LocaleEnum::validate($json['locale']);
        $updatedDate = isset($json['updatedDate']) ? new DateTime($json['updatedDate']) : null;

        return new Brand(
            $json['customer'],
            $json['handle'],
            $json['locale'],
            $json['organization'],
            $json['addressLine'],
            $json['postalCode'],
            $json['city'],
            $json['state'] ?? null,
            $json['country'],
            $json['email'],
            $json['url'] ?? null,
            $json['voice'],
            $json['fax'] ?? null,
            $json['privacyContact'] ?? null,
            $json['abuseContact'] ?? null,
            new DateTime($json['createdDate']),
            $updatedDate
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'customer' => $this->customer,
            'handle' => $this->handle,
            'locale' => $this->locale,
            'organization' => $this->organization,
            'addressLine' => $this->addressLine,
            'postalCode' => $this->postalCode,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'email' => $this->email,
            'url' => $this->url,
            'voice' => $this->voice,
            'fax' => $this->fax,
            'privacyContact' => $this->privacyContact,
            'abuseContact' => $this->abuseContact,
            'createdDate' => $this->createdDate->format('Y-m-d H:i:s'),
            'updatedDate' => $this->updatedDate ? $this->updatedDate->format('Y-m-d H:i:s') : null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
