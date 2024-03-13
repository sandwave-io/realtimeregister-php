<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use SandwaveIo\RealtimeRegister\Domain\DomainZoneCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainZoneRecordCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainZoneStatistics;
use SandwaveIo\RealtimeRegister\Domain\DomainZoneUpdate;
use SandwaveIo\RealtimeRegister\Domain\Zone;

final class ZonesApi extends AbstractApi
{
    /**
     * @see https://dm.realtimeregister.com/docs/api/dns/zones/get
     */
    public function get(int $zoneId): Zone
    {
        $response = $this->client->get("v2/dns/zones/{$zoneId}");
        return Zone::fromArray($response->json());
    }

    /** @see https://dm.realtimeregister.com/docs/api/dns/zones/list */
    public function list(
        ?int $limit = null,
        ?int $offset = null,
        ?array $includedFields = null,
    ): DomainZoneCollection {
        $query = [];
        if (! is_null($limit)) {
            $query['limit'] = $limit;
        }
        if (! is_null($offset)) {
            $query['offset'] = $offset;
        }

        if (! is_null($includedFields)) {
            $query['fields'] = implode(',', $includedFields);
        }

        $response = $this->client->get('v2/dns/zones', $query);
        return DomainZoneCollection::fromArray($response->json());
    }

    /** @see https://dm.realtimeregister.com/docs/api/dns/zones/create */
    public function create(
        string $name,
        ?string $service = null,
        ?string $template = null,
        ?string $master = null,
        ?array $ns = null,
        ?bool $dnssec = null,
        ?string $hostMaster = null,
        ?int $refresh = null,
        ?int $retry = null,
        ?int $expire = null,
        ?int $ttl = null,
        ?DomainZoneRecordCollection $records = null
    ): Zone {
        $payload = [
            'name' => $name,
        ];

        if ($service) {
            $payload['service'] = $service;
        }

        if ($template) {
            $payload['template'] = $template;
        }

        if ($master) {
            $payload['master'] = $master;
        }

        if ($ns) {
            $payload['ns'] = $ns;
        }

        if ($dnssec) {
            $payload['dnssec'] = $dnssec;
        }

        if ($hostMaster) {
            $payload['hostMaster'] = $hostMaster;
        }

        if ($refresh) {
            $payload['refresh'] = $refresh;
        }

        if ($retry) {
            $payload['retry'] = $retry;
        }

        if ($expire) {
            $payload['expire'] = $expire;
        }

        if ($ttl) {
            $payload['ttl'] = $ttl;
        }

        if ($records) {
            $payload['records'] = $records->toArray();
        }

        $response = $this->client->post('v2/dns/zones', $payload);

        return Zone::fromArray($response->json());
    }

    /** @see https://dm.realtimeregister.com/docs/api/dns/zones/update */
    public function update(
        int $zoneId,
        ?string $template,
        ?string $master,
        ?array $ns,
        ?bool $dnssec,
        ?string $hostMaster,
        ?int $refresh,
        ?int $retry,
        ?int $expire,
        ?int $ttl,
        ?DomainZoneRecordCollection $records
    ): DomainZoneUpdate {
        $payload = [
            'zoneId' => $zoneId,
        ];

        if ($template) {
            $payload['template'] = $template;
        }

        if ($master) {
            $payload['master'] = $master;
        }

        if ($ns) {
            $payload['ns'] = $ns;
        }

        if ($dnssec) {
            $payload['dnssec'] = $dnssec;
        }

        if ($hostMaster) {
            $payload['hostMaster'] = $hostMaster;
        }

        if ($refresh) {
            $payload['refresh'] = $refresh;
        }

        if ($retry) {
            $payload['retry'] = $retry;
        }

        if ($expire) {
            $payload['expire'] = $expire;
        }

        if ($ttl) {
            $payload['ttl'] = $ttl;
        }

        if ($records) {
            $payload['records'] = $records->toArray();
        }

        $result = $this->client->post("v2/dns/zones/{$zoneId}/update", $payload);

        return DomainZoneUpdate::fromArray($result->json());
    }

    /** @see https://dm.realtimeregister.com/docs/api/dns/zones/delete */
    public function delete(int $zoneId): void
    {
        $this->client->delete("v2/dns/zones/{$zoneId}");
    }

    /** @see https://dm.realtimeregister.com/docs/api/dns/zones/stats */
    public function statistics(int $zoneId): DomainZoneStatistics
    {
        $result = $this->client->get("v2/dns/zones/{$zoneId}/stats");

        return DomainZoneStatistics::fromArray($result->json());
    }

    /** @see https://dm.realtimeregister.com/docs/api/dns/zones/retrieve */
    public function retrieve(int $zoneId): void
    {
        $this->client->post("v2/dns/zones/{$zoneId}/retrieve");
    }

    /** @see https://dm.realtimeregister.com/docs/api/dns/zones/key-rollover */
    public function keyRollover(int $zoneId): void
    {
        $this->client->post("v2/dns/zones/{$zoneId}/key-rollover");
    }

    /** @see https://dm.realtimeregister.com/docs/api/dns/ack-ds-update */
    public function ackDSUpdate(int $processId): void
    {
        $this->client->post("v2/processes/{$processId}/ack-ds-update");
    }
}
