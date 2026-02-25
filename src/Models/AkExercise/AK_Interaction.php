<?php

namespace Algebrakit\SDK\Models\AkExercise;

use JsonSerializable;

abstract class AK_Interaction implements JsonSerializable
{
    public function __construct(
        public ?string $refId = null,
        public ?string $instruction = null,
        public ?bool $scored = null,
        public ?array $hints = null,
        public ?bool $enableCalculator = null
    ) {}

    abstract public function getType(): AK_InteractionType;

    public function jsonSerialize(): array
    {
        $data = ['type' => $this->getType()->value];
        if ($this->refId !== null) $data['refId'] = $this->refId;
        if ($this->instruction !== null) $data['instruction'] = $this->instruction;
        if ($this->scored !== null) $data['scored'] = $this->scored;
        if ($this->hints !== null) $data['hints'] = $this->hints;
        if ($this->enableCalculator !== null) $data['enableCalculator'] = $this->enableCalculator;
        return $data;
    }
}

class AK_InteractionChoice extends AK_Interaction
{
    public function __construct(
        public AK_SelectionPart $spec = new AK_SelectionPart(),
        ?string $refId = null,
        ?string $instruction = null,
        ?bool $scored = null,
        ?array $hints = null,
        ?bool $enableCalculator = null
    ) {
        parent::__construct($refId, $instruction, $scored, $hints, $enableCalculator);
    }

    public function getType(): AK_InteractionType { return AK_InteractionType::CHOICE; }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'spec' => $this->spec,
        ]);
    }
}

class AK_InteractionFITB extends AK_Interaction
{
    public function __construct(
        public string $content = '',
        public array $blanks = [],
        public ?array $interchangables = null,
        ?string $refId = null,
        ?string $instruction = null,
        ?bool $scored = null,
        ?array $hints = null,
        ?bool $enableCalculator = null
    ) {
        parent::__construct($refId, $instruction, $scored, $hints, $enableCalculator);
    }

    public function getType(): AK_InteractionType { return AK_InteractionType::FILL_IN_THE_BLANKS; }

    public function jsonSerialize(): array
    {
        $data = array_merge(parent::jsonSerialize(), [
            'content' => $this->content,
            'blanks' => $this->blanks,
        ]);
        if ($this->interchangables !== null) $data['interchangables'] = $this->interchangables;
        return $data;
    }
}

class AK_InteractionMultistep extends AK_Interaction
{
    public function __construct(
        public AK_MultistepPart $solutionPart,
        public ?array $givenParts = null,
        public ?array $intermediateParts = null,
        ?string $refId = null,
        ?string $instruction = null,
        ?bool $scored = null,
        ?array $hints = null,
        ?bool $enableCalculator = null
    ) {
        parent::__construct($refId, $instruction, $scored, $hints, $enableCalculator);
    }

    public function getType(): AK_InteractionType { return AK_InteractionType::MULTISTEP; }

    public function jsonSerialize(): array
    {
        $data = array_merge(parent::jsonSerialize(), [
            'solutionPart' => $this->solutionPart,
        ]);
        if ($this->givenParts !== null) $data['givenParts'] = $this->givenParts;
        if ($this->intermediateParts !== null) $data['intermediateParts'] = $this->intermediateParts;
        return $data;
    }
}

class AK_InteractionTable extends AK_Interaction
{
    public function __construct(
        public array $cells = [],
        ?string $refId = null,
        ?string $instruction = null,
        ?bool $scored = null,
        ?array $hints = null,
        ?bool $enableCalculator = null
    ) {
        parent::__construct($refId, $instruction, $scored, $hints, $enableCalculator);
    }

    public function getType(): AK_InteractionType { return AK_InteractionType::MATH_TABLE; }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'cells' => $this->cells,
        ]);
    }
}
