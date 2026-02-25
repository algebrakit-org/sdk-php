<?php

namespace Algebrakit\SDK\Models\AkExercise;

use JsonSerializable;

/**
 * The AK_Exercise specification format. A human-friendly way to define
 * mathematical exercises for the Algebrakit API.
 */
class AK_Exercise implements JsonSerializable
{
    public function __construct(
        public string $studentProfile = '',
        public array $elements = [],
        public array $symbols = [],
        public AK_QuestionMode $questionMode = AK_QuestionMode::ONE_BY_ONE,
        public int $version = 1,
        public ?string $script = null,
        public string $type = 'AK_Exercise'
    ) {}

    public function jsonSerialize(): array
    {
        $data = [
            'type' => $this->type,
            'version' => $this->version,
            'studentProfile' => $this->studentProfile,
            'symbols' => array_map(
                fn($s) => $s instanceof JsonSerializable ? $s->jsonSerialize() : $s,
                $this->symbols
            ),
            'elements' => array_map(
                fn($e) => $e instanceof JsonSerializable ? $e->jsonSerialize() : $e,
                $this->elements
            ),
            'questionMode' => $this->questionMode->value,
        ];
        if ($this->script !== null) $data['script'] = $this->script;
        return $data;
    }
}

class AK_Symbol implements JsonSerializable
{
    public function __construct(
        public string $name = '',
        public AK_SymbolType $type = AK_SymbolType::VARIABLE,
        public ?string $synonym = null,
        public ?bool $addToFormulaEditor = null,
        public ?array $notations = null
    ) {}

    public function jsonSerialize(): array
    {
        $data = [
            'name' => $this->name,
            'type' => $this->type->value,
        ];
        if ($this->synonym !== null) $data['synonym'] = $this->synonym;
        if ($this->addToFormulaEditor !== null) $data['addToFormulaEditor'] = $this->addToFormulaEditor;
        if ($this->notations !== null) $data['notations'] = $this->notations;
        return $data;
    }
}
