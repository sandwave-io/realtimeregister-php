<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use SandwaveIo\RealtimeRegister\Domain\Downtime;
use SandwaveIo\RealtimeRegister\Domain\DowntimeCollection;
use SandwaveIo\RealtimeRegister\Domain\Provider;
use SandwaveIo\RealtimeRegister\Domain\ProviderCollection;

final class ProvidersApi extends AbstractApi
{
    /**
     * @see https://dm.realtimeregister.com/docs/api/providers/get
     *
     * @param string $name
     *
     * @return Provider
     */
    public function get(string $name): Provider
    {
        $response = $this->client->get("/v2/providers/REGISTRY/{$name}");
        return Provider::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/providers/list
     *
     * @return ProviderCollection
     */
    public function list(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null
    ): ProviderCollection {
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

        $response = $this->client->get('v2/providers', $query);
        return ProviderCollection::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/providers/downtime/get
     *
     * @param int $id
     *
     * @return Downtime
     */
    public function getDowntime(int $id): Downtime
    {
        return Downtime::fromArray($this->client->get("/v2/providers/downtime/{$id}")->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/providers/downtime/list
     *
     * @param int|null    $limit
     * @param int|null    $offset
     * @param string|null $search
     *
     * @return DowntimeCollection
     */
    public function listDowntimes(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null
    ): DowntimeCollection {
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

        $response = $this->client->get('v2/providers/downtime', $query);
        return DowntimeCollection::fromArray($response->json());
    }
}
