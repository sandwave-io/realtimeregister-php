<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DomainContactCollection extends AbstractCollection
{
    /** @var DomainContact[] */
    public $entities;

    /** @var Pagination */
    public $pagination;

    /**
     * @param DomainContact[] $entities
     * @param Pagination      $pagination
     */
    private function __construct(array $entities, Pagination $pagination)
    {
        $this->entities = $entities;
        $this->pagination = $pagination;
    }

    public static function fromArray(array $json): DomainContactCollection
    {
        $pagination = Pagination::fromArray([
            'limit' => count($json),
            'offset' => 0,
            'total' => count($json),
        ]);
        $entities   = array_map(function ($country) {
            return DomainContact::fromArray($country);
        }, $json['entities']);

        return new DomainContactCollection($entities, $pagination);
    }

    public function offsetGet($offset): ?DomainContact
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }
}
