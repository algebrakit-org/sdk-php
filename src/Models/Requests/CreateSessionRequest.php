<?php

namespace Algebrakit\SDK\Models\Requests;

use Algebrakit\SDK\Models\Shared\Exercise;
use JsonSerializable;

class CreateSessionRequest implements JsonSerializable
{
    public function __construct(
        public array $exercises = [],
        public ?string $scoringModel = null,
        public bool $assessmentMode = false,
        public bool $requireLockForSolution = false,
        public int $apiVersion = 2
    ) {}

    public function jsonSerialize(): array
    {
        $data = [
            'exercises' => $this->exercises,
            'apiVersion' => $this->apiVersion
        ];

        if ($this->scoringModel !== null) {
            $data['scoringModel'] = $this->scoringModel;
        }

        if ($this->assessmentMode) {
            $data['assessmentMode'] = $this->assessmentMode;
        }

        if ($this->requireLockForSolution) {
            $data['requireLockForSolution'] = $this->requireLockForSolution;
        }

        return $data;
    }
}