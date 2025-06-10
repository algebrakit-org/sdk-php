<?php

namespace Algebrakit\SDK\Models\Shared;

class ExerciseBySpec extends Exercise
{
    public function __construct(
        public object $exerciseSpec = new \stdClass()
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'exerciseSpec' => $this->exerciseSpec
        ];
    }
}