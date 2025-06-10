<?php

namespace Algebrakit\SDK\Models\Responses;

use Algebrakit\SDK\Models\Shared\InteractionDescription;

class ExerciseValidateResponse
{
    public function __construct(
        public bool $valid,
        public ?bool $success = null,
        public ?string $msg = null,
        public ?float $marks = null,
        public ?bool $random = null,
        public ?array $interactions = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            valid: $data['valid'],
            success: $data['success'] ?? null,
            msg: $data['msg'] ?? null,
            marks: $data['marks'] ?? null,
            random: $data['random'] ?? null,
            interactions: $data['interactions'] ?? null
        );
    }
}