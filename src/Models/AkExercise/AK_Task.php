<?php

namespace Algebrakit\SDK\Models\AkExercise;

use JsonSerializable;

abstract class AK_Task implements JsonSerializable
{
    abstract public function getType(): AK_TaskType;

    public function jsonSerialize(): array
    {
        return ['type' => $this->getType()->value];
    }
}

class AK_TaskSimplify extends AK_Task
{
    public function __construct(
        public string $expression = ''
    ) {}

    public function getType(): AK_TaskType { return AK_TaskType::SIMPLIFY; }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'expression' => $this->expression,
        ]);
    }
}

class AK_TaskSolve extends AK_Task
{
    public function __construct(
        public string $expression = '',
        public string $variable = '',
        public ?string $domain = null
    ) {}

    public function getType(): AK_TaskType { return AK_TaskType::SOLVE; }

    public function jsonSerialize(): array
    {
        $data = array_merge(parent::jsonSerialize(), [
            'expression' => $this->expression,
            'variable' => $this->variable,
        ]);
        if ($this->domain !== null) $data['domain'] = $this->domain;
        return $data;
    }
}

class AK_TaskSolveSystem extends AK_Task
{
    public function __construct(
        public string $expression = '',
        public array $variables = [],
        public ?string $domain = null,
        public ?string $restrictVariable = null,
        public ?string $method = null
    ) {}

    public function getType(): AK_TaskType { return AK_TaskType::SOLVE_SYSTEM; }

    public function jsonSerialize(): array
    {
        $data = array_merge(parent::jsonSerialize(), [
            'expression' => $this->expression,
            'variables' => $this->variables,
        ]);
        if ($this->domain !== null) $data['domain'] = $this->domain;
        if ($this->restrictVariable !== null) $data['restrictVariable'] = $this->restrictVariable;
        if ($this->method !== null) $data['method'] = $this->method;
        return $data;
    }
}

class AK_TaskExpand extends AK_Task
{
    public function __construct(
        public string $expression = ''
    ) {}

    public function getType(): AK_TaskType { return AK_TaskType::EXPAND; }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'expression' => $this->expression,
        ]);
    }
}

class AK_TaskFactor extends AK_Task
{
    public function __construct(
        public string $expression = ''
    ) {}

    public function getType(): AK_TaskType { return AK_TaskType::FACTOR; }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'expression' => $this->expression,
        ]);
    }
}

class AK_TaskTogether extends AK_Task
{
    public function __construct(
        public string $expression = ''
    ) {}

    public function getType(): AK_TaskType { return AK_TaskType::TOGETHER; }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'expression' => $this->expression,
        ]);
    }
}

class AK_TaskCompleteSquare extends AK_Task
{
    public function __construct(
        public string $expression = '',
        public string $variable = ''
    ) {}

    public function getType(): AK_TaskType { return AK_TaskType::COMPLETE_SQUARE; }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'expression' => $this->expression,
            'variable' => $this->variable,
        ]);
    }
}

class AK_TaskPolynomialStandardForm extends AK_Task
{
    public function __construct(
        public string $expression = '',
        public string $variable = ''
    ) {}

    public function getType(): AK_TaskType { return AK_TaskType::POLYNOMIAL_STANDARD_FORM; }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'expression' => $this->expression,
            'variable' => $this->variable,
        ]);
    }
}

class AK_TaskPowerStandardForm extends AK_Task
{
    public function __construct(
        public string $expression = '',
        public string $variable = ''
    ) {}

    public function getType(): AK_TaskType { return AK_TaskType::POWER_STANDARD_FORM; }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'expression' => $this->expression,
            'variable' => $this->variable,
        ]);
    }
}

class AK_TaskExponentialStandardForm extends AK_Task
{
    public function __construct(
        public string $expression = '',
        public string $variable = ''
    ) {}

    public function getType(): AK_TaskType { return AK_TaskType::EXPONENTIAL_STANDARD_FORM; }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'expression' => $this->expression,
            'variable' => $this->variable,
        ]);
    }
}

class AK_TaskCartesianToPolarForm extends AK_Task
{
    public function __construct(
        public string $expression = ''
    ) {}

    public function getType(): AK_TaskType { return AK_TaskType::CARTESIAN_TO_POLAR_FORM; }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'expression' => $this->expression,
        ]);
    }
}

class AK_TaskPolarToCartesianForm extends AK_Task
{
    public function __construct(
        public string $expression = ''
    ) {}

    public function getType(): AK_TaskType { return AK_TaskType::POLAR_TO_CARTESIAN_FORM; }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'expression' => $this->expression,
        ]);
    }
}
