<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DomainAvailabilityCollection extends AbstractCollection
{
    /** @var DomainAvailability[] */
    public $entities;

    /** @var Pagination */
    public $pagination;

    /**
     * @param DomainAvailability[] $entities
     * @param Pagination      $pagination
     */
    private function __construct(array $entities, Pagination $pagination)
    {
        $this->entities = $entities;
        $this->pagination = $pagination;
    }

    public static function fromArray(array $json): DomainAvailabilityCollection
    {
        $pagination = Pagination::fromArray($json['pagination']);
        $entities   = array_map(function ($country) {
            return DomainAvailability::fromArray($country);
        }, $json['entities']);

        return new DomainAvailabilityCollection($entities, $pagination);
    }

    public function offsetGet($offset): ?DomainAvailability
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }
}
