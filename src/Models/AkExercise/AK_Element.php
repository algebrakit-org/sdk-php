<?php

namespace Algebrakit\SDK\Models\AkExercise;

use JsonSerializable;

class AK_Element implements JsonSerializable
{
    public function __construct(
        public array $blocks = []
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'blocks' => array_map(
                fn($b) => $b instanceof JsonSerializable ? $b->jsonSerialize() : $b,
                $this->blocks
            ),
        ];
    }
}

class AK_ContentBlock implements JsonSerializable
{
    public function __construct(
        public string $content = '',
        public ?string $id = null
    ) {}

    public function jsonSerialize(): array
    {
        $data = [
            'type' => AK_ElementBlockType::CONTENT->value,
            'content' => $this->content,
        ];
        if ($this->id !== null) $data['id'] = $this->id;
        return $data;
    }
}

class AK_InteractionBlock implements JsonSerializable
{
    public function __construct(
        public AK_Interaction $interaction,
        public ?string $id = null
    ) {}

    public function jsonSerialize(): array
    {
        $data = [
            'type' => AK_ElementBlockType::INTERACTION->value,
            'interaction' => $this->interaction,
        ];
        if ($this->id !== null) $data['id'] = $this->id;
        return $data;
    }
}
