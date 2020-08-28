<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use SandwaveIo\RealtimeRegister\Domain\ContactCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainAvailabilityCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainDetails;
use SandwaveIo\RealtimeRegister\Domain\DomainDetailsCollection;
use SandwaveIo\RealtimeRegister\Domain\KeyDataCollection;
use SandwaveIo\RealtimeRegister\Domain\Zone;

final class DomainsApi extends AbstractApi
{
    /**
     * @see https://dm.realtimeregister.com/docs/api/domains/get
     *
     * @param string $domainName
     *
     * @return DomainDetails
     */
    public function get(string $domainName): DomainDetails
    {
        $response = $this->client->get("v2/domains/{$domainName}");
        return DomainDetails::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/domains/list
     *
     * @param int|null    $limit
     * @param int|null    $offset
     * @param string|null $search
     *
     * @return DomainDetailsCollection
     */
    public function list(?int $limit = null, ?int $offset = null, ?string $search = null): DomainDetailsCollection
    {
        $query = [];
        if (! is_null($limit)) {
            $query['limit'] = $limit;
        }
        if (! is_null($offset)) {
            $query['offset'] = $offset;
        }
        if (! is_null($search)) {
            $query['search'] = $search;
        }

        $response = $this->client->get('v2/domains', $query);
        return DomainDetailsCollection::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/domains/check
     *
     * @param string $domainName
     * @param string|null $languageCode
     * @return DomainAvailabilityCollection
     */
    public function check(string $domainName, ?string $languageCode = null): DomainAvailabilityCollection
    {
        $query = [];
        if (! is_null($languageCode)) {
            $query['languageCode'] = $languageCode;
        }

        $response = $this->client->get("v2/domains/{$domainName}/check", $query);
        return DomainAvailabilityCollection::fromArray($response->json());
    }

    public function register(
        string $domainName,
        string $customer,
        string $registrant,
        bool $privacyProtect = false,
        ?int $period = null,
        ?string $authcode = null,
        ?string $languageCode = null,
        bool $autoRenew = true,
        array $ns = [],
        ?bool $skipValidation = null,
        ?string $launchPhase = null,
        ?Zone $zone = null,
        ?ContactCollection $contacts = null,
        ?KeyDataCollection $keyData = null, // TODO: Add the billables field after this, it also needs a domain object.
        bool $isQuote = false
    ): void {
        $payload = [
            'customer' => $customer,
            'registrant' => $registrant,
            'privacyProtect' => $privacyProtect,
            'period' => $period,
            'authcode' => $authcode,
            'languageCode' => $languageCode,
            'autoRenew' => $autoRenew,
            'ns' => $ns,
            'skipValidation' => $skipValidation,
            'launchPhase' => $launchPhase,
        ];

        if ($zone) {
            $payload['zone'] = $zone->toArray();
        }

        if ($contacts) {
            $payload['contacts'] = $contacts->toArray();
        }

        if ($keyData) {
            $payload['keyData'] = $keyData->toArray();
        }

        $response = $this->client->post("v2/domains/{$domainName}", $payload, [
            'quote' => $isQuote,
        ]);
        // TODO: Return a DomainRegistration
    }
}
