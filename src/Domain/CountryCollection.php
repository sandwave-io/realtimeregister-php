<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class CountryCollection extends AbstractCollection
{
    /** @var Country[] */
    public $entities;

    /** @var Pagination */
    public $pagination;

    /**
     * @param Country[]  $entities
     * @param Pagination $pagination
     */
    private function __construct(array $entities, Pagination $pagination)
    {
        $this->entities = $entities;
        $this->pagination = $pagination;
    }

    public static function fromArray(array $json): CountryCollection
    {
        $pagination = Pagination::fromArray($json['pagination']);
        $entities   = array_map(function ($country) {
            return Country::fromArray($country);
        }, $json['entities']);

        return new CountryCollection($entities, $pagination);
    }

    public function offsetGet($offset): ?Country
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }
}
