<?php

namespace Algebrakit\SDK\Models\Shared;

use Algebrakit\SDK\Enums\ExerciseStatus;

class EventResultInfo
{
    public function __construct(
        public int $timestamp,
        public string $event,
        public array $tags = [],
        public array $annotations = [],
        public ?ExerciseStatus $exerciseStatus = null,
        public ?float $progress = null,
        public ?ExerciseStatus $inputStatus = null,
        public ?array $skillsTodo = null
    ) {}

    public static function fromArray(array $data): self
    {
        $annotations = [];
        foreach ($data['annotations'] ?? [] as $annotationData) {
            $annotations[] = InfoAnnotation::fromArray($annotationData);
        }

        return new self(
            timestamp: $data['timestamp'],
            event: $data['event'],
            tags: $data['tags'] ?? [],
            annotations: $annotations,
            exerciseStatus: isset($data['exerciseStatus']) ? ExerciseStatus::from($data['exerciseStatus']) : null,
            progress: $data['progress'] ?? null,
            inputStatus: isset($data['inputStatus']) ? ExerciseStatus::from($data['inputStatus']) : null,
            skillsTodo: $data['skillsTodo'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'timestamp' => $this->timestamp,
            'event' => $this->event,
            'tags' => $this->tags,
            'annotations' => array_map(fn($annotation) => $annotation->toArray(), $this->annotations),
            'exerciseStatus' => $this->exerciseStatus?->value,
            'progress' => $this->progress,
            'inputStatus' => $this->inputStatus?->value,
            'skillsTodo' => $this->skillsTodo,
        ], fn($value) => $value !== null && $value !== []);
    }
}