<?php

namespace Algebrakit\SDK\Models\Shared;

class QuestionResult
{
    public function __construct(
        public string $id,
        public ?ScoringResult $scoring = null,
        public array $interactions = []
    ) {}
}