<?php

namespace Algebrakit\SDK\Models\Shared;

class ExerciseById extends Exercise
{
    public function __construct(
        public string $exerciseId = '',
        public string $version = 'latest'
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'exerciseId' => $this->exerciseId,
            'version' => $this->version
        ];
    }
}