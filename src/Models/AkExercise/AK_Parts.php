<?php

namespace Algebrakit\SDK\Models\AkExercise;

use JsonSerializable;

class AK_UnitSpec implements JsonSerializable
{
    public function __construct(
        public string $unit,
        public ?bool $allowEquivalentUnits = null,
        public ?bool $override = null
    ) {}

    public function jsonSerialize(): array
    {
        $data = ['unit' => $this->unit];
        if ($this->allowEquivalentUnits !== null) $data['allowEquivalentUnits'] = $this->allowEquivalentUnits;
        if ($this->override !== null) $data['override'] = $this->override;
        return $data;
    }
}

class AK_FormSpec implements JsonSerializable
{
    public function __construct(
        public ?AK_NumberForm $numbers = null,
        public ?AK_RadicalForm $radicals = null,
        public ?AK_FractionForm $fractions = null
    ) {}

    public function jsonSerialize(): array
    {
        $data = [];
        if ($this->numbers !== null) $data['numbers'] = $this->numbers->value;
        if ($this->radicals !== null) $data['radicals'] = $this->radicals->value;
        if ($this->fractions !== null) $data['fractions'] = $this->fractions->value;
        return $data;
    }
}

class AK_ExpressionPart implements JsonSerializable
{
    public function __construct(
        public AK_Task $task,
        public ?AK_AccuracyPreSpec $accuracy = null,
        public ?AK_UnitSpec $unit = null,
        public ?AK_FormSpec $form = null
    ) {}

    public function jsonSerialize(): array
    {
        $data = ['task' => $this->task];
        if ($this->accuracy !== null) $data['accuracy'] = $this->accuracy;
        if ($this->unit !== null) $data['unit'] = $this->unit;
        if ($this->form !== null) $data['form'] = $this->form;
        return $data;
    }
}

class AK_MultistepPart extends AK_ExpressionPart
{
    public function __construct(
        AK_Task $task,
        ?AK_AccuracyPreSpec $accuracy = null,
        ?AK_UnitSpec $unit = null,
        ?AK_FormSpec $form = null,
        public ?string $symbol = null,
        public ?string $description = null,
        public ?array $alternativeTasks = null
    ) {
        parent::__construct($task, $accuracy, $unit, $form);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();
        if ($this->symbol !== null) $data['symbol'] = $this->symbol;
        if ($this->description !== null) $data['description'] = $this->description;
        if ($this->alternativeTasks !== null) $data['alternativeTasks'] = $this->alternativeTasks;
        return $data;
    }
}

class AK_SelectionPart implements JsonSerializable
{
    public function __construct(
        public array $options = [],
        public bool $shuffle = false,
        public bool $multipleSelect = false
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'options' => array_map(fn($o) => $o instanceof JsonSerializable ? $o->jsonSerialize() : $o, $this->options),
            'shuffle' => $this->shuffle,
            'multipleSelect' => $this->multipleSelect,
        ];
    }
}

class AK_SelectionOption implements JsonSerializable
{
    public function __construct(
        public string $content = '',
        public bool $correct = false
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'content' => $this->content,
            'correct' => $this->correct,
        ];
    }
}

class AK_Blank implements JsonSerializable
{
    public function __construct(
        public string $id,
        public AK_ExpressionPart|AK_SelectionPart $input,
        public AK_FieldSize $size = AK_FieldSize::MEDIUM,
        public AK_BlankType $type = AK_BlankType::EXPRESSION
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'size' => $this->size->value,
            'type' => $this->type->value,
            'input' => $this->input,
        ];
    }
}

class AK_Cell implements JsonSerializable
{
    public function __construct(
        public AK_CellType $type = AK_CellType::TEXT,
        public int $row = 0,
        public int $col = 0,
        public bool $isHeader = false,
        public ?string $content = null,
        public ?string $value = null,
        public ?AK_ExpressionPart $spec = null
    ) {}

    public function jsonSerialize(): array
    {
        $data = [
            'type' => $this->type->value,
            'row' => $this->row,
            'col' => $this->col,
            'isHeader' => $this->isHeader,
        ];
        if ($this->content !== null) $data['content'] = $this->content;
        if ($this->value !== null) $data['value'] = $this->value;
        if ($this->spec !== null) $data['spec'] = $this->spec;
        return $data;
    }
}

class AK_AccuracyPreSpec implements JsonSerializable
{
    public function __construct(
        public AK_AccuracyType $type = AK_AccuracyType::ROUND,
        public int $nr = 0,
        public ?bool $keepDecimalZeros = null
    ) {}

    public function jsonSerialize(): array
    {
        $data = [
            'type' => $this->type->value,
            'nr' => $this->nr,
        ];
        if ($this->keepDecimalZeros !== null) $data['keepDecimalZeros'] = $this->keepDecimalZeros;
        return $data;
    }
}
