<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use DateTimeImmutable;
use SandwaveIo\RealtimeRegister\Domain\Certificate;
use SandwaveIo\RealtimeRegister\Domain\CertificateCollection;
use SandwaveIo\RealtimeRegister\Domain\CertificateInfoProcess;
use SandwaveIo\RealtimeRegister\Domain\Enum\DownloadFormatEnum;
use SandwaveIo\RealtimeRegister\Domain\Product;
use SandwaveIo\RealtimeRegister\Domain\ProductCollection;

final class CertificatesApi extends AbstractApi
{
    /* @see https://dm.realtimeregister.com/docs/api/ssl/get */
    public function getCertificate(int $certificateId): Certificate
    {
        $response = $this->client->get('/v2/ssl/certificates/' . $certificateId);

        return Certificate::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/list */
    public function listCertificates(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): CertificateCollection {
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

        $response = $this->client->get('/v2/ssl/certificates', $query);

        return CertificateCollection::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/download */
    public function downloadCertificate(int $certificateId, string $format = 'CRT'): string
    {
        DownloadFormatEnum::validate($format);

        $response = $this->client->get('/v2/ssl/certificates/' . $certificateId . '/download', ['format' => $format]);

        return $response->text();
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/dcvemailaddresslist */
    public function listDcvEmailAddresses(string $domainName, string $product = null): array
    {

        $response = $this->client->get('/v2/ssl/dcvemailaddresslist/' . $domainName . ($product ? '?product=' . $product : ''));

        return $response->json();
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/products/get */
    public function getProduct(string $product): Product
    {
        $response = $this->client->get('/v2/ssl/products/' . $product);

        return Product::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/products/list */
    public function listProducts(
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null,
        ?array $parameters = null
    ): ProductCollection {
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

        $response = $this->client->get('/v2/ssl/products', $query);

        return ProductCollection::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/request */
    public function requestCertificate(
        string $customer,
        string $product,
        int $period,
        string $csr,
        ?array $san = null,
        ?string $organization = null,
        ?string $department = null,
        ?string $address = null,
        ?string $postalCode = null,
        ?string $city = null,
        ?string $coc = null,
        ?string $saEmail = null,
        ?array $approver = null,
        ?string $country = null,
        ?string $language = null,
        ?array $dcv = null,
        ?string $domainName = null,
        ?string $authKey = null,
        ?string $state = null,
    ) {
        $payload = [
            'customer' => $customer,
            'product' => $product,
            'period' => $period,
            'csr' => $csr,
        ];

        if (! is_null($san)) {
            $payload['san'] = $san;
        }

        if (! is_null($organization)) {
            $payload['organization'] = $organization;
        }

        if (! is_null($department)) {
            $payload['department'] = $department;
        }

        if (! is_null($address)) {
            $payload['address'] = $address;
        }

        if (! is_null($postalCode)) {
            $payload['postalCode'] = $postalCode;
        }

        if (! is_null($city)) {
            $payload['city'] = $city;
        }

        if (! is_null($country)) {
            $payload['country'] = $country;
        }

        if (! is_null($coc)) {
            $payload['coc'] = $coc;
        }

        if (! is_null($saEmail)) {
            $payload['saEmail'] = $saEmail;
        }

        if (! is_null($language)) {
            $payload['language'] = $language;
        }

        if (! is_null($approver)) {
            $payload['approver'] = $approver;
        }

        if (! is_null($dcv)) {
            $payload['dcv'] = $dcv;
        }

        if (! is_null($domainName)) {
            $payload['domainName'] = $domainName;
        }

        if (! is_null($authKey)) {
            $payload['authKey'] = $authKey;
        }

        if (! is_null($state)) {
            $payload['state'] = $state;
        }

        $response = $this->client->post('/v2/ssl/certificates', $payload);

        return CertificateInfoProcess::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/renew */
    public function renewCertificate(
        int $certificateId,
        int $period,
        string $csr,
        ?array $san = null,
        ?string $organization = null,
        ?string $department = null,
        ?string $address = null,
        ?string $postalCode = null,
        ?string $city = null,
        ?string $coc = null,
        ?string $saEmail = null,
        ?array $approver = null,
        ?string $country = null,
        ?string $language = null,
        ?array $dcv = null,
        ?string $domainName = null,
        ?string $authKey = null,
        ?string $state = null,
        ?string $product = null,
    ) {
        $payload = [
            'period' => $period,
            'csr' => $csr,
        ];

        if (! is_null($san)) {
            $payload['san'] = $san;
        }

        if (! is_null($organization)) {
            $payload['organization'] = $organization;
        }

        if (! is_null($department)) {
            $payload['department'] = $department;
        }

        if (! is_null($country)) {
            $payload['country'] = $country;
        }

        if (! is_null($address)) {
            $payload['address'] = $address;
        }

        if (! is_null($postalCode)) {
            $payload['postalCode'] = $postalCode;
        }

        if (! is_null($city)) {
            $payload['city'] = $city;
        }

        if (! is_null($coc)) {
            $payload['coc'] = $coc;
        }

        if (! is_null($saEmail)) {
            $payload['saEmail'] = $saEmail;
        }

        if (! is_null($language)) {
            $payload['language'] = $language;
        }

        if (! is_null($approver)) {
            $payload['approver'] = $approver;
        }

        if (! is_null($dcv)) {
            $payload['dcv'] = $dcv;
        }

        if (! is_null($domainName)) {
            $payload['domainName'] = $domainName;
        }

        if (! is_null($authKey)) {
            $payload['authKey'] = $authKey;
        }

        if (! is_null($state)) {
            $payload['state'] = $state;
        }

        if (! is_null($product)) {
            $payload['product'] = $product;
        }

        $response = $this->client->post('/v2/ssl/certificates/' . $certificateId . '/renew', $payload);

        return CertificateInfoProcess::fromArray($response->json());
    }

    /** @see https://dm.realtimeregister.com/docs/api/ssl/reissue */
    public function reissueCertificate(
        int $certificateId,
        string $csr,
        ?array $san = null,
        ?string $organization = null,
        ?string $department = null,
        ?string $address = null,
        ?string $postalCode = null,
        ?string $city = null,
        ?string $coc = null,
        ?array $approver = null,
        ?string $country = null,
        ?string $language = null,
        ?array $dcv = null,
        ?string $domainName = null,
        ?string $authKey = null,
        ?string $state = null,
    ) {
        $payload = [
            'csr' => $csr,
        ];

        if (! is_null($san)) {
            $payload['san'] = $san;
        }

        if (! is_null($organization)) {
            $payload['organization'] = $organization;
        }

        if (! is_null($department)) {
            $payload['department'] = $department;
        }

        if (! is_null($country)) {
            $payload['country'] = $country;
        }

        if (! is_null($address)) {
            $payload['address'] = $address;
        }

        if (! is_null($postalCode)) {
            $payload['postalCode'] = $postalCode;
        }

        if (! is_null($city)) {
            $payload['city'] = $city;
        }

        if (! is_null($coc)) {
            $payload['coc'] = $coc;
        }

        if (! is_null($language)) {
            $payload['language'] = $language;
        }

        if (! is_null($approver)) {
            $payload['approver'] = $approver;
        }

        if (! is_null($dcv)) {
            $payload['dcv'] = $dcv;
        }

        if (! is_null($domainName)) {
            $payload['domainName'] = $domainName;
        }

        if (! is_null($authKey)) {
            $payload['authKey'] = $authKey;
        }

        if (! is_null($state)) {
            $payload['state'] = $state;
        }

        $response = $this->client->post('/v2/ssl/certificates/' . $certificateId . '/reissue', $payload);

        return CertificateInfoProcess::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/ssl/revoke */
    public function revokeCertificate(int $certificateId, ?string $reason = null): void
    {
        $payload = [];

        if (! is_null($reason)) {
            $payload['reason'] = $reason;
        }

        $this->client->delete('/v2/ssl/certificates/' . $certificateId, $payload);
    }

    public function sendSubscriberAgreement(int $processId, string $email, ?string $language): void
    {
        $payload = [
            'email' => $email,
        ];

        if (! is_null($language)) {
            $payload['language'] = $language;
        }

        $this->client->post('/v2/processes/' . $processId . '/send-subscriber-agreement', $payload);
    }

    /** @see https://dm.realtimeregister.com/docs/api/ssl/add-note */
    public function addNote(int $processId, string $message): void
    {
        $payload = [
            'message' => $message,
        ];

        $this->client->post('/v2/processes/' . $processId . '/add-note', $payload);
    }

    /** @see https://dm.realtimeregister.com/docs/api/ssl/schedule-validation-call */
    public function scheduleValidationCall(int $processId, DateTimeImmutable $date): void
    {
        $payload = [
            'date' => $date,
        ];

        $this->client->post('/v2/processes/' . $processId . '/schedule-validation-call', $payload);
    }

    /** @see https://dm.realtimeregister.com/docs/api/processes/info */
    public function info(int $processId): CertificateInfoProcess
    {
        $response = $this->client->get('/v2/processes/' . $processId . '/info');

        return CertificateInfoProcess::fromArray($response->json());

    }

    /** @see https://dm.realtimeregister.com/docs/api/ssl/import */
    public function importCertificate(string $customer, string $certificate, ?string $csr, ?string $coc): void
    {
        $payload = [
            'customer' => $customer,
            'certificate' => $certificate,
        ];

        if (! is_null($csr)) {
            $payload['csr'] = $csr;
        }

        if (! is_null($coc)) {
            $payload['coc'] = $coc;
        }

        $this->client->post('/v2/ssl/import', $payload);
    }

    /** @see https://dm.realtimeregister.com/docs/api/ssl/decocdecsr */
    public function decodeCsr(string $csr): array
    {
        $response = $this->client->post('/v2/ssl/decodecsr', ['csr' => $csr]);

        return $response->json();
    }

    /** @see https://dm.realtimeregister.com/docs/api/ssl/generate-authkey */
    public function generateAuthKey(string $product, string $csr): array
    {
        $payload = [
            'product' => $product,
            'csr' => $csr,
        ];

        $response = $this->client->post('/v2/ssl/authkey', $payload);

        return $response->json();
    }
}
