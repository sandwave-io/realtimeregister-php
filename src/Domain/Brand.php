<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use Carbon\Carbon;
use SandwaveIo\RealtimeRegister\Domain\Enum\LocaleEnum;

final class Brand implements DomainObjectInterface
{
    /** @var string */
    public $customer;

    /** @var string */
    public $handle;

    /** @var string */
    public $locale;

    /** @var string */
    public $organization;

    /** @var string[]|null */
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

    /** @var string|null */
    public $url;

    /** @var string */
    public $voice;

    /** @var string|null */
    public $fax;

    /** @var string|null */
    public $privacyContact;

    /** @var string */
    public $abuseContact;

    /** @var Carbon */
    public $createdDate;

    /** @var Carbon|null */
    public $updatedDate;

    private function __construct(
        string $customer,
        string $handle,
        string $locale,
        string $organization,
        ?array $addressLine,
        string $postalCode,
        string $city,
        ?string $state,
        string $country,
        string $email,
        ?string $url,
        string $voice,
        ?string $fax,
        ?string $privacyContact,
        string $abuseContact,
        Carbon $createdDate,
        ?Carbon $updatedDate
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
        $updatedDate = isset($json['updatedDate']) ? new Carbon($json['updatedDate']) : null;

        return new Brand(
            $json['customer'],
            $json['handle'],
            $json['locale'],
            $json['organization'],
            $json['addressLine'] ?? null,
            $json['postalCode'],
            $json['city'],
            $json['state'] ?? null,
            $json['country'],
            $json['email'],
            $json['url'] ?? null,
            $json['voice'],
            $json['fax'] ?? null,
            $json['privacyContact'] ?? null,
            $json['abuseContact'],
            new Carbon($json['createdDate']),
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
            'createdDate' => $this->createdDate->toDateTimeString(),
            'updatedDate' => $this->updatedDate ? $this->updatedDate->toDateTimeString() : null,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
