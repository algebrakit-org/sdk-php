<?php

namespace Algebrakit\SDK\Models\Shared;

class ScoringResult
{
    public function __construct(
        public bool $finished,
        public float $marksTotal,
        public float $marksEarned,
        public ?Penalties $penalties = null
    ) {}
}