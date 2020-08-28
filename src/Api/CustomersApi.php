<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use SandwaveIo\RealtimeRegister\Domain\AccountCollection;
use SandwaveIo\RealtimeRegister\Domain\PriceCollection;

final class CustomersApi extends AbstractApi
{
    /**
     * @see https://dm.realtimeregister.com/docs/api/customers/pricelist
     *
     * @param string $customer
     *
     * @return PriceCollection
     */
    public function priceList(string $customer): PriceCollection
    {
        $response = $this->client->get("v2/customers/{$customer}/pricelist");
        return PriceCollection::fromArray($response->json());
    }

    /**
     * @see https://dm.realtimeregister.com/docs/api/customers/credits
     *
     * @param string $customer
     *
     * @return AccountCollection
     */
    public function credits(string $customer): AccountCollection
    {
        $response = $this->client->get("v2/customers/{$customer}/credit");
        return AccountCollection::fromArray($response->json());
    }
}
