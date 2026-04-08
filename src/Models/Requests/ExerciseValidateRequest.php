<?php

namespace Algebrakit\SDK\Models\Requests;

use Algebrakit\SDK\Models\AkExercise\AK_Exercise;
use JsonSerializable;

class ExerciseValidateRequest implements JsonSerializable
{
    public function __construct(
        public ?string $exerciseId = null,
        public string|int|null $version = null,
        public ?AK_Exercise $exerciseSpec = null
    ) {}

    public function jsonSerialize(): array
    {
        $data = [];
        
        if ($this->exerciseId !== null) {
            $data['exerciseId'] = $this->exerciseId;
            if ($this->version !== null) {
                $data['version'] = $this->version;
            }
        } elseif ($this->exerciseSpec !== null) {
            $data['exerciseSpec'] = $this->exerciseSpec;
        }

        return $data;
    }
}