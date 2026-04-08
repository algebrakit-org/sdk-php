<?php

namespace Algebrakit\SDK\Models\Shared;

use Algebrakit\SDK\Models\AkExercise\AK_Exercise;

class ExerciseBySpec extends Exercise
{
    public function __construct(
        public AK_Exercise $exerciseSpec = new AK_Exercise()
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'exerciseSpec' => $this->exerciseSpec
        ];
    }
}