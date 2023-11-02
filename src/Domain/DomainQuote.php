<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class DomainQuote implements DomainObjectInterface
{
    public function __construct(
        public readonly string $command,
        public readonly Quote $quote,
    ) {
    }

    public function toArray(): array
    {
        return [
            'command' => $this->command,
            'quote' => $this->quote->toArray(),
        ];
    }

    public static function fromArray(array $json): DomainQuote
    {
        return new DomainQuote(
            command: $json['command'],
            quote: Quote::fromArray($json['quote'])
        );
    }
}
