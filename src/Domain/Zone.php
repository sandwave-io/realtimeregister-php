<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class Zone implements DomainObjectInterface
{
    /** @var string */
    public $template;

    /** @var bool|null */
    public $link;

    private function __construct(string $template, ?bool $link)
    {
        $this->template = $template;
        $this->link = $link;
    }

    public static function fromArray(array $data): Zone
    {
        return new Zone(
            $data['template'],
            $data['link'] ?: null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'template' => $this->template,
            'link' => $this->link,
        ], function ($x) { return !is_null($x); });
    }
}
