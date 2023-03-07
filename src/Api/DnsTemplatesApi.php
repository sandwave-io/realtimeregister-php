<?php declare(strict_types=1);

namespace SandwaveIo\RealtimeRegister\Api;

use InvalidArgumentException;
use Webmozart\Assert\Assert;
use SandwaveIo\RealtimeRegister\Domain\DnsTemplate;
use SandwaveIo\RealtimeRegister\Domain\DnsTemplateCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainZoneRecord;
use SandwaveIo\RealtimeRegister\Domain\DomainZoneRecordCollection;

final class DnsTemplatesApi extends AbstractApi
{
    /**
     * @see https://dm.realtimeregister.com/docs/api/templates/list
     * @param string $customer
     * @param int|null $limit
     * @param int|null $offset
     * @param string|null $search
     * @param array|null $parameters
     * @return DnsTemplateCollection
     * @throws InvalidArgumentException
     */
    public function list(
        string $customer,
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): DnsTemplateCollection
    {
        $this->validateCustomerHandle($customer);
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

        $response = $this->client->get(
            sprintf("v2/customers/%s/dnstemplates", urlencode($customer)),
            $query
        );
        return DnsTemplateCollection::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/templates/get
     * @param string $customer
     * @param string $name Name of the template
     * @return DnsTemplate
     * @throws InvalidArgumentException
     */
    public function get(string $customer, string $name): DnsTemplate
    {
        $this->validateCustomerHandle($customer);
        $this->validateTemplateName($name);
        $response = $this->client->get(
            sprintf("v2/customers/%s/dnstemplates/%s", urlencode($customer), urlencode($name))
        );
        return DnsTemplate::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/templates/create
     * @param string $customer
     * @param string $name Name of the template
     * @param string $hostMaster
     * @param int $refresh
     * @param int $retry
     * @param int $expire
     * @param int $ttl
     * @param ?DomainZoneRecordCollection $records
     * @return void
     * @throws InvalidArgumentException
     */
    public function create(
        string $customer,
        string $name,
        string $hostMaster,
        int $refresh,
        int $retry,
        int $expire,
        int $ttl,
        ?DomainZoneRecordCollection $records = null
    ): void
    {
        $this->validateCustomerHandle($customer);
        $this->validateTemplateName($name);
        $payload = [
            'hostMaster' => $hostMaster,
            'refresh'    => $refresh,
            'retry'      => $retry,
            'expire'     => $expire,
            'ttl'        => $ttl
        ];
        if ($records) {
            $payload['records'] = $records->toArray();
        }

        $this->client->post(
            sprintf("v2/customers/%s/dnstemplates/%s", urlencode($customer), urlencode($name)),
            $payload
        );
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/templates/update
     * @param string $customer
     * @param string $name Name of the template
     * @param string $hostMaster
     * @param int $refresh
     * @param int $retry
     * @param int $expire
     * @param int $ttl
     * @param ?DomainZoneRecordCollection $records
     * @return void
     * @throws InvalidArgumentException
     */
    public function update(
        string $customer,
        string $name,
        string $hostMaster,
        int $refresh,
        int $retry,
        int $expire,
        int $ttl,
        ?DomainZoneRecordCollection $records = null
    ): void
    {
        $this->validateCustomerHandle($customer);
        $this->validateTemplateName($name);
        $payload = [
            'hostMaster' => $hostMaster,
            'refresh'    => $refresh,
            'retry'      => $retry,
            'expire'     => $expire,
            'ttl'        => $ttl
        ];
        if ($records) {
            $payload['records'] = $records->toArray();
        }

        $this->client->post(
            sprintf("v2/customers/%s/dnstemplates/%s/update", urlencode($customer), urlencode($name)),
            $payload
        );
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/templates/delete
     * @param string $customer
     * @param string $name Name of the template
     * @return void
     * @throws InvalidArgumentException
     */
    public function delete(string $customer, string $name): void
    {
        $this->validateCustomerHandle($customer);
        $this->validateTemplateName($name);
        $this->client->delete(
            sprintf("v2/customers/%s/dnstemplates/%s", urlencode($customer), urlencode($name))
        );
    }

    /**
     * Validate customer handle input
     * @param string $customer
     * @return void
     * @throws InvalidArgumentException
     */
    private function validateCustomerHandle(string $customer): void
    {
        Assert::lengthBetween($customer,3, 40, 'Customer handle should be between 3 and 40 characters');
        Assert::regex($customer, '/^[a-zA-Z0-9\-_@.]+$/', 'Invalid customer handle, allowed characters: a-z A-Z 0-9 - _ @ .');
    }

    /**
     * Validate template name input
     * @param string $name
     * @return void
     * @throws InvalidArgumentException
     */
    private function validateTemplateName(string $name): void
    {
        Assert::lengthBetween($name,3, 40, 'Template name should be between 3 and 40 characters');
        Assert::regex($name, '/^[a-zA-Z0-9\-_@.]+$/', 'Invalid template name, allowed characters: a-z A-Z 0-9 - _ @ .');
    }
}
