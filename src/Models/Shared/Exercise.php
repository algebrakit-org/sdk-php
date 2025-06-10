<?php

namespace Algebrakit\SDK\Models\Shared;

use JsonSerializable;

abstract class Exercise implements JsonSerializable
{
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}