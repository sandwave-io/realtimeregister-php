<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use SandwaveIo\RealtimeRegister\Domain\TLDInfo;

final class TLDsApi extends AbstractApi
{
    /**
     * @see https://dm.realtimeregister.com/docs/api/tlds/info
     */
    public function info(string $tld): TLDInfo
    {
        $response = $this->client->get("v2/tlds/{$tld}/info");
        return TLDInfo::fromArray($response->json());
    }
}
