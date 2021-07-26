<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class Nameservers implements DomainObjectInterface
{
    public int $min;
    public int $max;
    public bool $required;

    private function __construct(int $min, int $max, bool $required)
    {
        $this->min = $min;
        $this->max = $max;
        $this->required = $required;
    }

    public static function fromArray(array $json): Nameservers
    {
        return new Nameservers(
            $json['min'],
            $json['max'],
            $json['required']
        );
    }

    public function toArray(): array
    {
        return [
            'min' =>$this->min,
            'max' =>$this->max,
            'required' =>$this->required,
        ];
    }
}
