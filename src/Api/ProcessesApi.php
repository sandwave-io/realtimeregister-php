<?php

declare(strict_types=1);

namespace SandwaveIo\RealtimeRegister\Api;

use Exception;
use SandwaveIo\RealtimeRegister\Domain\Process;
use SandwaveIo\RealtimeRegister\Domain\ProcessCollection;

final class ProcessesApi extends AbstractApi
{
    /**
     * @see https://dm.yoursrs-ote.com/docs/api/processes/get
     *
     * @param int $processId
     *
     * @return Process
     * @throws Exception
     */
    public function get(int $processId): Process
    {
        $response = $this->client->get(sprintf('v2/processes/%d', $processId));
        return Process::fromArray($response->json());
    }

    /**
     * @see https://dm.yoursrs-ote.com/docs/api/processes/list
     *
     * @param int|null $limit
     * @param int|null $offset
     * @param string|null $search
     *
     * @return ProcessCollection
     */
    public function list(?int $limit = null, ?int $offset = null, ?string $search = null): ProcessCollection
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

        $response = $this->client->get('v2/processes', $query);
        return ProcessCollection::fromArray($response->json());
    }

    /**
     * @see https://dm.yoursrs-ote.com/docs/api/processes/resend
     *
     * @param int $processId
     */
    public function resend(int $processId): void
    {
        $this->client->post(sprintf('v2/processes/%d/resend', $processId));
    }

    /**
     * @see https://dm.yoursrs-ote.com/docs/api/processes/cancel
     *
     * @param int $processId
     */
    public function delete(int $processId): void
    {
        $this->client->delete(sprintf('v2/processes/%d', $processId));
    }
}
