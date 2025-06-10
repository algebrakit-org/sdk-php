<?php

namespace Algebrakit\SDK\Models\Responses;

class ExerciseInfoResponse
{
    public function __construct(
        public ?array $commitHistory = null,
        public ?string $id = null,
        public ?array $publishedVersions = null,
        public ?string $courseName = null,
        public ?string $type = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            commitHistory: $data['commitHistory'] ?? null,
            id: $data['id'] ?? null,
            publishedVersions: $data['publishedVersions'] ?? null,
            courseName: $data['courseName'] ?? null,
            type: $data['type'] ?? null
        );
    }
}