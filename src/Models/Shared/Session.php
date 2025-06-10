<?php

namespace Algebrakit\SDK\Models\Shared;

class Session
{
    public function __construct(
        public bool $success,
        public string $sessionId,
        public string $type,
        public string $html,
        public float $marksTotal,
        public array $interactions = [],
        public ?string $msg = null,
        public ?bool $solution = null
    ) {}
}