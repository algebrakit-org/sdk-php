<?php

namespace Algebrakit\SDK\Models\Shared;

class InteractionScoring
{
    public function __construct(
        public bool $finished,
        public float $marksTotal,
        public float $marksEarned,
        public ?array $penalties = null
    ) {}
}