<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class PriceCollection extends AbstractCollection
{
    /** @var Price[] */
    public $entities;

    /** @var Pagination */
    public $pagination;

    /**
     * @param Price[]    $entities
     * @param Pagination $pagination
     */
    private function __construct(array $entities, Pagination $pagination)
    {
        $this->entities = $entities;
        $this->pagination = $pagination;
    }

    public static function fromArray(array $json): PriceCollection
    {
        $pagination = Pagination::fromArray($json['pagination']);
        $entities   = array_map(function ($country) {
            return Price::fromArray($country);
        }, $json['entities']);

        return new PriceCollection($entities, $pagination);
    }

    public function offsetGet($offset): ?Price
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }
}
