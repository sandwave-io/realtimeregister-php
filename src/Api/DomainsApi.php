<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use DateTime;
use Exception;
use SandwaveIo\RealtimeRegister\Domain\BillableCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainAvailability;
use SandwaveIo\RealtimeRegister\Domain\DomainContactCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainDetails;
use SandwaveIo\RealtimeRegister\Domain\DomainDetailsCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainQuote;
use SandwaveIo\RealtimeRegister\Domain\DomainRegistration;
use SandwaveIo\RealtimeRegister\Domain\DomainTransferStatus;
use SandwaveIo\RealtimeRegister\Domain\DomainZone;
use SandwaveIo\RealtimeRegister\Domain\DomainZoneRecord;
use SandwaveIo\RealtimeRegister\Domain\Enum\DomainDesignatedAgentEnum;
use SandwaveIo\RealtimeRegister\Domain\Enum\DomainStatusEnum;
use SandwaveIo\RealtimeRegister\Domain\KeyDataCollection;
use SandwaveIo\RealtimeRegister\Domain\Zone;

final class DomainsApi extends AbstractApi
{
    /* @see https://dm.realtimeregister.com/docs/api/domains/get */
    public function get(string $domainName): DomainDetails
    {
        $response = $this->client->get("v2/domains/{$domainName}");
        return DomainDetails::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/domains/list */
    public function list(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): DomainDetailsCollection {
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

        $response = $this->client->get('v2/domains', $query);
        return DomainDetailsCollection::fromArray($response->json());
    }

    public function export(array $parameters = []): array {
        $query = $parameters;
        $query['export'] = 'true';
        $response = $this->client->get('v2/domains', $query);
        return $response->json()['entities'];
    }

    /* @see https://dm.realtimeregister.com/docs/api/domains/check */
    public function check(string $domainName, ?string $languageCode = null): DomainAvailability
    {
        $query = [];
        if (! is_null($languageCode)) {
            $query['languageCode'] = $languageCode;
        }

        $response = $this->client->get("v2/domains/{$domainName}/check", $query);
        return DomainAvailability::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/domains/zoneinfo */
    public function zone(string $domainName): DomainZone
    {
        $response = $this->client->get("v2/domains/{$domainName}/zone");
        return DomainZone::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/domains/zoneupdate
     *
     * @param DomainZoneRecord[] $records
     */
    public function zoneUpdate(string $domainName, string $hostMaster, int $refresh, int $retry, int $expire, int $ttl, ?array $records = null): void
    {
        $data = [
            'hostMaster' => $hostMaster,
            'refresh' => $refresh,
            'retry' => $retry,
            'expire' => $expire,
            'ttl' => $ttl,
        ];

        if ($records !== null) {
            $data['records'] = $records;
        }

        $this->client->post("v2/domains/{$domainName}/zone/update", $data);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/domains/create
     *
     * @param string[] $ns
     */
    public function register(
        string $domainName,
        string $customer,
        string $registrant,
        bool $privacyProtect = false,
        ?int $period = null,
        ?string $authcode = null,
        ?string $languageCode = null,
        bool $autoRenew = true,
        ?array $ns = null,
        ?bool $skipValidation = null,
        ?string $launchPhase = null,
        ?Zone $zone = null,
        ?DomainContactCollection $contacts = null,
        ?KeyDataCollection $keyData = null,
        ?BillableCollection $billables = null,
        bool $isQuote = false
    ): DomainRegistration|DomainQuote {
        $payload = [
            'customer' => $customer,
            'registrant' => $registrant,
            'privacyProtect' => $privacyProtect,
            'period' => $period,
            'authcode' => $authcode,
            'languageCode' => $languageCode,
            'autoRenew' => $autoRenew,
            'skipValidation' => $skipValidation,
            'launchPhase' => $launchPhase,
        ];

        if (is_array($ns)) {
            $payload['ns'] = $ns;
        }

        if ($zone) {
            $payload['zone'] = $zone->toArray();
        }

        if ($contacts) {
            $payload['contacts'] = $contacts->toArray();
        }

        if ($keyData) {
            $payload['keyData'] = $keyData->toArray();
        }

        if ($billables) {
            $payload['billables'] = $billables->toArray();
        }

        $response = $this->client->post("v2/domains/{$domainName}", $payload, [
            'quote' => $isQuote ? 'true' : 'false',
        ]);

        if ($isQuote) {
            return DomainQuote::fromArray($response->json());
        }

        return DomainRegistration::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/domains/update
     *
     * @param string[]|null $ns
     * @param string[]|null $statuses
     */
    public function update(
        string $domainName,
        ?string $registrant = null,
        ?bool $privacyProtect = null,
        ?int $period = null,
        ?string $authcode = null,
        ?string $languageCode = null,
        ?bool $autoRenew = null,
        ?array $ns = null,
        ?array $statuses = null,
        ?string $designatedAgent = null,
        ?Zone $zone = null,
        ?DomainContactCollection $contacts = null,
        ?KeyDataCollection $keyData = null,
        ?BillableCollection $billables = null,
        bool $isQuote = false
    ): DomainQuote|null {
        $payload = [];

        if (is_string($registrant)) {
            $payload['registrant'] = $registrant;
        }

        if (is_bool($privacyProtect)) {
            $payload['privacyProtect'] = $privacyProtect;
        }

        if (is_int($period)) {
            $payload['period'] = $period;
        }

        if (is_string($authcode)) {
            $payload['authcode'] = $authcode;
        }

        if (is_string($languageCode)) {
            $payload['languageCode'] = $languageCode;
        }

        if (is_bool($autoRenew)) {
            $payload['autoRenew'] = $autoRenew;
        }

        if (is_array($ns)) {
            $payload['ns'] = $ns;
        }

        if (is_array($statuses)) {
            foreach ($statuses as $status) {
                DomainStatusEnum::validate($status);
            }
            $payload['status'] = $statuses;
        }

        if (is_string($designatedAgent)) {
            DomainDesignatedAgentEnum::validate($designatedAgent);
            $payload['designatedAgent'] = $designatedAgent;
        }

        if ($zone instanceof Zone) {
            $payload['zone'] = $zone->toArray();
        }

        if ($contacts instanceof DomainContactCollection) {
            $payload['contacts'] = $contacts->toArray();
        }

        if ($keyData instanceof KeyDataCollection) {
            $payload['keyData'] = $keyData->toArray();
        }

        if ($billables instanceof BillableCollection) {
            $payload['billables'] = $billables->toArray();
        }

        $response = $this->client->post("v2/domains/{$domainName}/update", $payload, [
            'quote' => $isQuote,
        ]);

        if ($isQuote) {
            return DomainQuote::fromArray($response->json());
        }

        return null;
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/domains/update
     *
     * @throws Exception
     */
    public function transfer(
        string $domainName,
        string $customer,
        string $registrant,
        ?bool $privacyProtect = null,
        ?int $period = null,
        ?string $authcode = null,
        ?bool $autoRenew = null,
        ?array $ns = null,
        ?string $transferContacts = null,
        ?string $designatedAgent = null,
        ?Zone $zone = null,
        ?DomainContactCollection $contacts = null,
        ?KeyDataCollection $keyData = null,
        ?BillableCollection $billables = null,
        ?bool $isQuote = null
    ): DomainTransferStatus|DomainQuote {
        $payload = [
            'customer' => $customer,
            'registrant' => $registrant,
        ];

        if (is_bool($privacyProtect)) {
            $payload['privacyProtect'] = $privacyProtect;
        }

        if (is_int($period)) {
            $payload['period'] = $period;
        }

        if (is_string($authcode)) {
            $payload['authcode'] = $authcode;
        }

        if (is_bool($autoRenew)) {
            $payload['autoRenew'] = $autoRenew;
        }

        if (is_array($ns)) {
            $payload['ns'] = $ns;
        }

        if (is_string($transferContacts)) {
            $payload['transferContacts'] = $transferContacts;
        }

        if (is_string($designatedAgent)) {
            DomainDesignatedAgentEnum::validate($designatedAgent);
            $payload['designatedAgent'] = $designatedAgent;
        }

        if ($zone instanceof Zone) {
            $payload['zone'] = $zone;
        }

        if ($contacts instanceof DomainContactCollection) {
            $payload['contacts'] = $contacts->toArray();
        }

        if ($keyData instanceof KeyDataCollection) {
            $payload['keyData'] = $keyData->toArray();
        }

        if ($billables instanceof BillableCollection) {
            $payload['billables'] = $billables->toArray();
        }

        $response = $this->client->post("v2/domains/{$domainName}/transfer", $payload, [
            'quote' => $isQuote,
        ]);

        if ($isQuote) {
            return DomainQuote::fromArray($response->json());
        }

        return DomainTransferStatus::fromArray($response->json());
    }

    /** @see https://dm.realtimeregister.com/docs/api/domains/pushtransfer */
    public function pushTransfer(string $domain, string $recipient): void
    {
        $this->client->post("v2/domains/{$domain}/transfer/push", [
            'recipient' => $recipient,
        ]);
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/domains/transferinfo
     *
     * @throws Exception
     */
    public function transferInfo(string $domain, ?string $processId = null): DomainTransferStatus
    {
        if (null === $processId) {
            $endpoint = sprintf('v2/domains/%s/transfer', $domain);
        } else {
            $endpoint = sprintf('v2/domains/%s/transfer/%s', $domain, $processId);
        }

        $response = $this->client->get($endpoint);

        return DomainTransferStatus::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/domains/transferinfo
     *
     * @throws Exception
     */
    public function renew(string $domain, int $period, ?BillableCollection $billables = null, ?bool $isQuote = null): DateTime|DomainQuote
    {
        $payload = [
            'period' => $period,
        ];

        if ($billables instanceof BillableCollection) {
            $payload['billables'] = $billables;
        }

        $response = $this->client->post("v2/domains/{$domain}/renew", $payload, is_null($isQuote) ? [] : [
            'quote' => $isQuote,
        ]);

        if ($isQuote) {
            return DomainQuote::fromArray($response->json());
        }

        return new DateTime($response->json()['expiryDate']);
    }

    /** @see https://dm.realtimeregister.com/docs/api/domains/delete */
    public function delete(string $domain): void
    {
        $this->client->delete("v2/domains/{$domain}");
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/domains/restore
     *
     * @throws Exception
     */
    public function restore(
        string $domain,
        string $reason,
        ?BillableCollection $billables = null,
        ?bool $isQuote = null
    ): DateTime|DomainQuote {
        $payload = [
            'reason' => $reason,
        ];

        if ($billables instanceof BillableCollection) {
            $payload['billables'] = $billables;
        }

        $response = $this->client->post("v2/domains/{$domain}/restore", $payload, is_null($isQuote) ? [] : [
            'quote' => $isQuote,
        ]);

        if ($isQuote) {
            return DomainQuote::fromArray($response->json());
        }

        return new DateTime($response->json()['expiryDate']);
    }
}
