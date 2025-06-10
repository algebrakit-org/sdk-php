<?php

namespace Algebrakit\SDK\Models\Responses;

class SessionLockResponse
{
    public function __construct() {}

    public static function fromArray(array $data): self
    {
        return new self();
    }
}