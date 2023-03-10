<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

use SandwaveIo\RealtimeRegister\Domain\Enum\TemplateNameEnum;

final class Template implements DomainObjectInterface
{
    public string $name;

    public ?string $subject;

    public ?string $text;

    public ?string $html;

    public array $contexts;

    private function __construct(
        string $name,
        ?string $subject,
        ?string $text,
        ?string $html,
        array $contexts
    ) {
        $this->name = $name;
        $this->subject = $subject;
        $this->text = $text;
        $this->html = $html;
        $this->contexts = $contexts;
    }

    public static function fromArray(array $json): Template
    {
        TemplateNameEnum::validate($json['name']);

        return new Template(
            $json['name'],
            $json['subject'] ?? null,
            $json['text'] ?? null,
            $json['html'] ?? null,
            $json['contexts']
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'subject' => $this->subject,
            'text' => $this->text,
            'html' => $this->html,
            'contexts' => $this->contexts,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
