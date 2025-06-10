<?php

namespace Algebrakit\SDK\Models\Shared;

class ExerciseBySession extends Exercise
{
    public function __construct(
        public string $sessionId = ''
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'sessionId' => $this->sessionId
        ];
    }
}