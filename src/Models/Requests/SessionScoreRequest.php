<?php

namespace Algebrakit\SDK\Models\Requests;

use JsonSerializable;

class SessionScoreRequest implements JsonSerializable
{
    public function __construct(
        public string $sessionId,
        public bool $lockSession = false
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'sessionId' => $this->sessionId,
            'lockSession' => $this->lockSession
        ];
    }
}