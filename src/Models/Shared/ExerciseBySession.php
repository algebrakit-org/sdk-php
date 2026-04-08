<?php

namespace Algebrakit\SDK\Models\Shared;

class ExerciseBySession extends Exercise
{
    public function __construct(
        public string $sessionId = '',
        public ?int $nr = null
    ) {}

    public function jsonSerialize(): array
    {
        $data = [
            'sessionId' => $this->sessionId
        ];
        if ($this->nr !== null) $data['nr'] = $this->nr;
        return $data;
    }
}