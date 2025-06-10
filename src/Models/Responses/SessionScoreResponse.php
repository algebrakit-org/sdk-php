<?php

namespace Algebrakit\SDK\Models\Responses;

use Algebrakit\SDK\Models\Shared\QuestionResult;
use Algebrakit\SDK\Models\Shared\InteractionScoring;

class SessionScoreResponse
{
    public function __construct(
        public bool $success,
        public array $questions = [],
        public ?array $tagDescriptions = null,
        public ?InteractionScoring $scoring = null
    ) {}

    public static function fromArray(array $data): self
    {
        $questions = [];
        if (isset($data['questions'])) {
            foreach ($data['questions'] as $questionData) {
                $questions[] = new QuestionResult(
                    id: $questionData['id'],
                    scoring: isset($questionData['scoring']) ? new \Algebrakit\SDK\Models\Shared\ScoringResult(
                        finished: $questionData['scoring']['finished'],
                        marksTotal: $questionData['scoring']['marksTotal'],
                        marksEarned: $questionData['scoring']['marksEarned']
                    ) : null,
                    interactions: $questionData['interactions'] ?? []
                );
            }
        }

        $scoring = null;
        if (isset($data['scoring'])) {
            $scoring = new InteractionScoring(
                finished: $data['scoring']['finished'],
                marksTotal: $data['scoring']['marksTotal'],
                marksEarned: $data['scoring']['marksEarned'],
                penalties: $data['scoring']['penalties'] ?? null
            );
        }

        return new self(
            success: true,
            questions: $questions,
            tagDescriptions: $data['tagDescriptions'] ?? null,
            scoring: $scoring
        );
    }
}