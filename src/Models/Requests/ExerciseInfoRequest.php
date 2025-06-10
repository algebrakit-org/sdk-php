<?php

namespace Algebrakit\SDK\Models\Requests;

use JsonSerializable;

class ExerciseInfoRequest implements JsonSerializable
{
    public function __construct(
        public string $id
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id
        ];
    }
}