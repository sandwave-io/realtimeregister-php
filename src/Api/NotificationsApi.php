<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Api;

use SandwaveIo\RealtimeRegister\Domain\Notification;
use SandwaveIo\RealtimeRegister\Domain\NotificationCollection;
use SandwaveIo\RealtimeRegister\Domain\NotificationPoll;

final class NotificationsApi extends AbstractApi
{
    /* @see https://dm.realtimeregister.com/docs/api/notifications/get */
    public function get(string $customer, int $notificationId): Notification
    {
        $response = $this->client->get("v2/customers/{$customer}/notifications/{$notificationId}");
        return Notification::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/notifications/list */
    public function list(
        string $customer,
        ?int $limit = null,
        ?int $offset = null,
        ?string $search = null
    ): NotificationCollection {
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

        $response = $this->client->get("v2/customers/{$customer}/notifications", $query);
        return NotificationCollection::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/notifications/poll */
    public function poll(string $customer): NotificationPoll
    {
        $response = $this->client->get("v2/customers/{$customer}/notifications/poll");
        return NotificationPoll::fromArray($response->json());
    }

    /* @see https://dm.realtimeregister.com/docs/api/notifications/ack */
    public function ack(string $customer, int $notificationId): void
    {
        $this->client->post("v2/customers/{$customer}/notifications/{$notificationId}/ack");
    }
}
