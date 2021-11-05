<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use SandwaveIo\RealtimeRegister\Domain\Downtime;
use SandwaveIo\RealtimeRegister\Domain\DowntimeCollection;
use SandwaveIo\RealtimeRegister\Domain\Provider;
use SandwaveIo\RealtimeRegister\Domain\ProviderCollection;

final class ProvidersApi extends AbstractApi
{
    /* @see https://dm.realtimeregister.com/docs/api/providers/get */
    public function get(string $name): Provider
    {
        $response = $this->client->get("/v2/providers/REGISTRY/{$name}");
        return Provider::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/providers/list */
    public function list(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): ProviderCollection {
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
        if (! is_null($parameters)) {
            $query = array_merge($parameters, $query);
        }

        $response = $this->client->get('v2/providers', $query);
        return ProviderCollection::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/providers/downtime/get */
    public function getDowntime(int $id): Downtime
    {
        return Downtime::fromArray($this->client->get("/v2/providers/downtime/{$id}")->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/providers/downtime/list */
    public function listDowntimes(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): DowntimeCollection {
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
        if (! is_null($parameters)) {
            $query = array_merge($parameters, $query);
        }

        $response = $this->client->get('v2/providers/downtime', $query);
        return DowntimeCollection::fromArray($response->json());
    }
}
