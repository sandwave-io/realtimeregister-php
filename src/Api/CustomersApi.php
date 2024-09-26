<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use SandwaveIo\RealtimeRegister\Domain\AccountCollection;
use SandwaveIo\RealtimeRegister\Domain\PriceCollection;
use SandwaveIo\RealtimeRegister\Domain\PromoCollection;

final class CustomersApi extends AbstractApi
{
    /* @see https://dm.realtimeregister.com/docs/api/customers/pricelist */
    public function priceList(string $customer): PriceCollection
    {
        $response = $this->client->get("v2/customers/{$customer}/pricelist");
        return PriceCollection::fromArray($response->json()['prices']);
    }

    /* @see https://dm.realtimeregister.com/docs/api/customers/pricelist#promos  */
    public function promoList(string $customer): PromoCollection
    {
        $response = $this->client->get("v2/customers/{$customer}/pricelist");
        return PromoCollection::fromArray($response->json()['promos']);
    }

    /* @see https://dm.realtimeregister.com/docs/api/customers/credits */
    public function credits(string $customer): AccountCollection
    {
        $response = $this->client->get("v2/customers/{$customer}/credit");
        return AccountCollection::fromArray($response->json()['accounts']);
    }
}
