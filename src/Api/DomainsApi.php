<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use SandwaveIo\RealtimeRegister\Domain\DomainDetails;
use SandwaveIo\RealtimeRegister\Domain\DomainDetailsCollection;

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
     * @param string      $customer
     * @param int|null    $limit
     * @param int|null    $offset
     * @param string|null $search
     *
     * @return DomainDetailsCollection
     */
    public function list(string $customer, ?int $limit = null, ?int $offset = null, ?string $search = null): DomainDetailsCollection
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
}
