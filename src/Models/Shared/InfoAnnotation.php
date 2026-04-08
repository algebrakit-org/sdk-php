<?php

namespace Algebrakit\SDK\Models\Shared;

use Algebrakit\SDK\Enums\AnnotationType;

class InfoAnnotation
{
    public function __construct(
        public AnnotationType $type,
        public ?string $expression = null,
        public ?string $content = null,
        public ?int $gapIndex = null,
        public ?int $row = null,
        public ?int $col = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            type: AnnotationType::from($data['type']),
            expression: $data['expression'] ?? null,
            content: $data['content'] ?? null,
            gapIndex: $data['gapIndex'] ?? null,
            row: $data['row'] ?? null,
            col: $data['col'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type->value,
            'expression' => $this->expression,
            'content' => $this->content,
            'gapIndex' => $this->gapIndex,
            'row' => $this->row,
            'col' => $this->col,
        ], fn($value) => $value !== null);
    }
}