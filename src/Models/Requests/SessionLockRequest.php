<?php

namespace Algebrakit\SDK\Models\Requests;

use JsonSerializable;

class SessionLockRequest implements JsonSerializable
{
    public function __construct(
        public string $action,
        public array $sessionIds
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'action' => $this->action,
            'sessionIds' => $this->sessionIds
        ];
    }
}