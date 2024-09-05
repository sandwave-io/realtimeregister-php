<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use InvalidArgumentException;
use SandwaveIo\RealtimeRegister\Domain\DnsZone;
use SandwaveIo\RealtimeRegister\Domain\DnsZoneCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainZoneRecordCollection;
use SandwaveIo\RealtimeRegister\Domain\Enum\ZoneServiceEnum;
use Webmozart\Assert\Assert;

final class DnsZonesApi extends AbstractApi
{
    /**
     * @see https://dm.realtimeregister.com/docs/api/dns/zones/list
     *
     * @param int|null    $limit
     * @param int|null    $offset
     * @param string|null $search
     * @param array|null  $parameters
     *
     * @throws InvalidArgumentException
     *
     * @return DnsZoneCollection
     */
    public function list(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): DnsZoneCollection {
        $query = [];
        if ($limit !== null) {
            $query['limit'] = $limit;
        }
        if ($offset !== null) {
            $query['offset'] = $offset;
        }
        if ($search !== null) {
            $query['q'] = $search;
        }
        if ($parameters !== null) {
            $query = array_merge($parameters, $query);
        }

        $response = $this->client->get('v2/dns/zones', $query);
        return DnsZoneCollection::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/dns/zones/get
     *
     * @param int $id
     *
     * @throws InvalidArgumentException
     *
     * @return DnsZone
     */
    public function get(int $id): DnsZone
    {
        $response = $this->client->get(
            sprintf('v2/dns/zones/%s', $id)
        );
        return DnsZone::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/dns/zones/create
     *
     * @throws InvalidArgumentException
     */
    public function create(
        string $name,
        ?ZoneServiceEnum $service = null,
        ?string $template = null,
        ?bool $link = null,
        ?string $master = null,
        ?array $ns = null,
        ?bool $dnssec = null,
        ?string $hostMaster = null,
        ?int $refresh = null,
        ?int $retry = null,
        ?int $expire = null,
        ?int $ttl = null,
        ?DomainZoneRecordCollection $records = null,
    ): void {
        $this->validateZoneName($name);

        $payload = [
            'name' => $name,
        ];
        if ($service !== null) {
            $payload['service'] = $service->value;
        }
        if ($template !== null) {
            $payload['template'] = $template;
        }
        if ($link !== null) {
            $payload['link'] = $link;
        }
        if ($master !== null) {
            $payload['master'] = $master;
        }
        if ($ns !== null) {
            $payload['ns'] = $ns;
        }
        if ($dnssec !== null) {
            $payload['dnssec'] = $dnssec;
        }
        if ($hostMaster !== null) {
            $payload['hostMaster'] = $hostMaster;
        }
        if ($refresh !== null) {
            $payload['refresh'] = $refresh;
        }
        if ($retry !== null) {
            $payload['retry'] = $retry;
        }
        if ($expire !== null) {
            $payload['expire'] = $expire;
        }
        if ($ttl !== null) {
            $payload['ttl'] = $ttl;
        }
        if ($records !== null) {
            $payload['records'] = $records->toArray();
        }

        $this->client->post('v2/dns/zones', $payload);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/dns/zones/update
     *
     * @throws InvalidArgumentException
     */
    public function update(
        int $id,
        ?string $name,
        ?ZoneServiceEnum $service = null,
        ?string $template = null,
        ?bool $link = null,
        ?string $master = null,
        ?array $ns = null,
        ?bool $dnssec = null,
        ?string $hostMaster = null,
        ?int $refresh = null,
        ?int $retry = null,
        ?int $expire = null,
        ?int $ttl = null,
        ?DomainZoneRecordCollection $records = null,
    ): void {
        $payload = [];
        if ($name !== null) {
            $this->validateZoneName($name);
            $payload['name'] = $name;
        }
        if ($service !== null) {
            $payload['service'] = $service->value;
        }
        if ($template !== null) {
            $payload['template'] = $template;
        }
        if ($link !== null) {
            $payload['link'] = $link;
        }
        if ($master !== null) {
            $payload['master'] = $master;
        }
        if ($ns !== null) {
            $payload['ns'] = $ns;
        }
        if ($dnssec !== null) {
            $payload['dnssec'] = $dnssec;
        }
        if ($hostMaster !== null) {
            $payload['hostMaster'] = $hostMaster;
        }
        if ($refresh !== null) {
            $payload['refresh'] = $refresh;
        }
        if ($retry !== null) {
            $payload['retry'] = $retry;
        }
        if ($expire !== null) {
            $payload['expire'] = $expire;
        }
        if ($ttl !== null) {
            $payload['ttl'] = $ttl;
        }
        if ($records !== null) {
            $payload['records'] = $records->toArray();
        }

        $this->client->post(
            sprintf('v2/dns/zones/%s/update', $id),
            $payload,
        );
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/dns/zones/delete
     *
     * @param int $id The id of the zone to delete
     */
    public function delete(int $id): void
    {
        $this->client->delete(
            sprintf('v2/dns/zones/%s', $id)
        );
    }

    /**
     * Validate zone name input.
     *
     * @param string $name Zone name
     *
     * @throws InvalidArgumentException
     */
    private function validateZoneName(string $name): void
    {
        Assert::lengthBetween($name, 3, 40, 'Zone name should be between 3 and 40 characters');
        Assert::regex($name, '/^[a-zA-Z0-9\-_@.]+$/', 'Invalid zone name, allowed characters: a-z A-Z 0-9 - _ @ .');
    }
}
