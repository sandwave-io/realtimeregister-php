<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use DateTime;
use SandwaveIo\RealtimeRegister\Domain\BillableCollection;
use SandwaveIo\RealtimeRegister\Domain\ContactCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainAvailability;
use SandwaveIo\RealtimeRegister\Domain\DomainContactCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainDetails;
use SandwaveIo\RealtimeRegister\Domain\DomainDetailsCollection;
use SandwaveIo\RealtimeRegister\Domain\DomainRegistration;
use SandwaveIo\RealtimeRegister\Domain\DomainTransferStatus;
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
            $query['q'] = $search;
        }

        $response = $this->client->get('v2/domains', $query);
        return DomainDetailsCollection::fromArray($response->json());
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
        array $ns = [],
        ?bool $skipValidation = null,
        ?string $launchPhase = null,
        ?Zone $zone = null,
        ?DomainContactCollection $contacts = null,
        ?KeyDataCollection $keyData = null,
        ?BillableCollection $billables = null,
        bool $isQuote = false
    ): DomainRegistration {
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

        if ($billables) {
            $payload['billables'] = $billables->toArray();
        }

        $response = $this->client->post("v2/domains/{$domainName}", $payload, [
            'quote' => $isQuote,
        ]);

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
        ?ContactCollection $contacts = null,
        ?KeyDataCollection $keyData = null,
        ?BillableCollection $billables = null,
        bool $isQuote = false
    ): void {
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
            $payload['zone'] = $zone;
        }

        if ($contacts instanceof ContactCollection) {
            $payload['contacts'] = $contacts;
        }

        if ($keyData instanceof KeyDataCollection) {
            $payload['keyData'] = $keyData;
        }

        if ($billables instanceof BillableCollection) {
            $payload['billables'] = $billables;
        }

        $this->client->post("v2/domains/{$domainName}/update", $payload, [
            'quote' => $isQuote,
        ]);
    }

    /* @see https://dm.realtimeregister.com/docs/api/domains/update */
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
    ): void {
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

        $this->client->post("v2/domains/{$domainName}/transfer", $payload, [
            'quote' => $isQuote,
        ]);
    }

    /** @see https://dm.realtimeregister.com/docs/api/domains/pushtransfer */
    public function pushTransfer(string $domain, string $recipient): void
    {
        $this->client->post("v2/domains/{$domain}/transfer/push", [
            'recipient' => $recipient,
        ]);
    }

    /** @see https://dm.realtimeregister.com/docs/api/domains/transferinfo */
    public function transferInfo(string $domain, string $processId): DomainTransferStatus
    {
        $response = $this->client->get("v2/domains/{$domain}/transfer/{$processId}");
        return DomainTransferStatus::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/domains/transferinfo */
    public function renew(string $domain, int $period, ?BillableCollection $billables = null, ?bool $quote = null): DateTime
    {
        $payload = [
            'period' => $period,
        ];

        if ($billables instanceof BillableCollection) {
            $payload['billables'] = $billables;
        }

        $response = $this->client->post("v2/domains/{$domain}/renew", $payload, is_null($quote) ? [] : [
            'quote' => $quote,
        ]);

        return new DateTime($response->json()['expiryDate']);
    }

    /** @see https://dm.realtimeregister.com/docs/api/domains/delete */
    public function delete(string $domain): void
    {
        $this->client->delete("v2/domains/{$domain}");
    }

    /** @see https://dm.realtimeregister.com/docs/api/domains/restore */
    public function restore(string $domain, string $reason, ?BillableCollection $billables = null, ?bool $quote = null): DateTime
    {
        $payload = [
            'reason' => $reason,
        ];

        if ($billables instanceof BillableCollection) {
            $payload['billables'] = $billables;
        }

        $response = $this->client->post("v2/domains/{$domain}/restore", $payload, is_null($quote) ? [] : [
            'quote' => $quote,
        ]);

        return new DateTime($response->json()['expiryDate']);
    }
}
