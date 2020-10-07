<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class TemplatePreview implements DomainObjectInterface
{
    /** @var string|null */
    public $subject;

    /** @var string|null */
    public $text;

    /** @var string|null */
    public $html;

    private function __construct(
        ?string $subject,
        ?string $text,
        ?string $html
    ) {
        $this->subject = $subject;
        $this->text = $text;
        $this->html = $html;
    }

    public static function fromArray(array $json): TemplatePreview
    {
        return new TemplatePreview(
            $json['subject'] ?? null,
            $json['text'] ?? null,
            $json['html'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'subject' => $this->subject,
            'text' => $this->text,
            'html' => $this->html,
        ], function ($x) {
            return ! is_null($x);
        });
    }
}
