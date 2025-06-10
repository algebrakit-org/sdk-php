<?php

namespace Algebrakit\SDK\Models\Responses;

use Algebrakit\SDK\Models\Shared\Session;

class SessionRetrieveResponse
{
    public function __construct(
        public array $sessions = []
    ) {}

    public static function fromArray(array $data): self
    {
        $sessions = [];
        foreach ($data as $sessionData) {
            $sessions[] = new Session(
                success: $sessionData['success'],
                sessionId: $sessionData['sessionId'],
                type: $sessionData['type'],
                html: $sessionData['html'],
                marksTotal: $sessionData['marksTotal'],
                interactions: $sessionData['interactions'] ?? [],
                msg: $sessionData['msg'] ?? null,
                solution: $sessionData['solution'] ?? null
            );
        }

        return new self(sessions: $sessions);
    }
}