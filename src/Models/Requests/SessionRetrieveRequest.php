<?php

namespace Algebrakit\SDK\Models\Requests;

use JsonSerializable;

class SessionRetrieveRequest implements JsonSerializable
{
    public function __construct(
        public array $sessionIds
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'sessionIds' => $this->sessionIds
        ];
    }
}