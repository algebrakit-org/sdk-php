<?php

namespace Algebrakit\SDK\Models\Shared;

class Penalties
{
    public function __construct(
        public float $marksPenalty = 0.0,
        public int $hintsRequested = 0,
        public int $mathErrors = 0
    ) {}

    public function toArray(): array
    {
        return [
            'marksPenalty' => $this->marksPenalty,
            'hintsRequested' => $this->hintsRequested,
            'mathErrors' => $this->mathErrors
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            marksPenalty: (float) ($data['marksPenalty'] ?? 0.0),
            hintsRequested: (int) ($data['hintsRequested'] ?? 0),
            mathErrors: (int) ($data['mathErrors'] ?? 0)
        );
    }
}