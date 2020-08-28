<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class AccountCollection extends AbstractCollection
{
    /** @var Account[] */
    public $entities;

    /** @var Pagination */
    public $pagination;

    /**
     * @param Account[]  $entities
     * @param Pagination $pagination
     */
    private function __construct(array $entities, Pagination $pagination)
    {
        $this->entities = $entities;
        $this->pagination = $pagination;
    }

    public static function fromArray(array $json): AccountCollection
    {
        $pagination = Pagination::fromArray($json['pagination']);
        $entities   = array_map(function ($country) {
            return Account::fromArray($country);
        }, $json['entities']);

        return new AccountCollection($entities, $pagination);
    }

    public function offsetGet($offset): ?Account
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }
}
