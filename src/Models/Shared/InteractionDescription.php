<?php

namespace Algebrakit\SDK\Models\Shared;

use Algebrakit\SDK\Enums\InteractionType;

class InteractionDescription
{
    public function __construct(
        public InteractionType $type,
        public float $marks,
        public bool $scorable
    ) {}
}