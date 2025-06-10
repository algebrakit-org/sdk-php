<?php

namespace Algebrakit\SDK\Models\Responses;

use Algebrakit\SDK\Models\Shared\Session;

class CreateSessionResponse
{
    public function __construct(
        public bool $success,
        public array $sessions = [],
        public ?string $msg = null
    ) {}

    public static function fromArray(array $data): self
    {
        $sessions = [];
        if (isset($data['sessions'])) {
            foreach ($data['sessions'] as $sessionData) {
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
        }

        return new self(
            success: $data['success'],
            sessions: $sessions,
            msg: $data['msg'] ?? null
        );
    }
}