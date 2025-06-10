<?php

namespace Algebrakit\SDK\Models\Responses;

class SessionInfoResponse
{
    public function __construct(
        public array $elements = [],
        public ?array $tagDescriptions = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            elements: $data['elements'] ?? [],
            tagDescriptions: $data['tagDescriptions'] ?? null
        );
    }
}