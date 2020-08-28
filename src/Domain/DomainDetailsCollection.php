<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DomainDetailsCollection extends AbstractCollection
{
    /** @var DomainDetails[] */
    public $entities;

    /** @var Pagination */
    public $pagination;

    /**
     * @param DomainDetails[] $entities
     * @param Pagination      $pagination
     */
    private function __construct(array $entities, Pagination $pagination)
    {
        $this->entities = $entities;
        $this->pagination = $pagination;
    }

    public static function fromArray(array $json): DomainDetailsCollection
    {
        $pagination = Pagination::fromArray($json['pagination']);
        $entities   = array_map(function ($country) {
            return DomainDetails::fromArray($country);
        }, $json['entities']);

        return new DomainDetailsCollection($entities, $pagination);
    }

    public function offsetGet($offset): ?DomainDetails
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }
}
