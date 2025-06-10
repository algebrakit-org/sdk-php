<?php

namespace Algebrakit\SDK\Models\Requests;

use JsonSerializable;

class SessionInfoRequest implements JsonSerializable
{
    public function __construct(
        public string $sessionId
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'sessionId' => $this->sessionId
        ];
    }
}