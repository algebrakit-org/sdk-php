<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Algebrakit\SDK\Services\SessionService;
use Algebrakit\SDK\Models\Requests\CreateSessionRequest;
use Algebrakit\SDK\Models\Requests\SessionScoreRequest;
use Algebrakit\SDK\Models\Requests\SessionInfoRequest;
use Algebrakit\SDK\Models\Requests\ExerciseInfoRequest;
use Algebrakit\SDK\Models\Requests\ExerciseValidateRequest;
use Algebrakit\SDK\Models\Shared\ExerciseById;

// Define the exercise ID as a constant
const EXERCISE_ID = 'fa42e943-8213-41a6-8a91-8c22a929ffe9';

// Initialize the SessionService with API key
$apiKey = 'your-api-key'; // Replace with your actual API key
$sessionService = new SessionService($apiKey);

try {
    // Read published info for the exercise
    $exerciseInfoRequest = new ExerciseInfoRequest(EXERCISE_ID);
    $exerciseInfoResponse = $sessionService->getExerciseInfo($exerciseInfoRequest);
    
    if ($exerciseInfoResponse) {
        echo "Exercise Info for " . EXERCISE_ID . ": Course Name: {$exerciseInfoResponse->courseName}, Type: {$exerciseInfoResponse->type}\n";
    } else {
        echo "Failed to retrieve exercise published info.\n";
    }

    // Validate the exercise
    $validateRequest = new ExerciseValidateRequest(exerciseId: EXERCISE_ID);
    $validateResponse = $sessionService->validateExercise($validateRequest);
    
    if ($validateResponse) {
        echo "Exercise Validate for " . EXERCISE_ID . ": Valid: " . ($validateResponse->valid ? 'true' : 'false') . ", Marks: {$validateResponse->marks}\n";
    } else {
        echo "Failed to validate exercise.\n";
    }

    // Create a session for the exercise
    $createSessionRequest = new CreateSessionRequest(
        exercises: [new ExerciseById(EXERCISE_ID, 'latest')]
    );

    $createSessionResponse = $sessionService->createSession($createSessionRequest);

    if (!empty($createSessionResponse)) {
        foreach ($createSessionResponse as $response) {
            if ($response->success && !empty($response->sessions)) {
                $session = $response->sessions[0];
                $sessionId = $session->sessionId;
                echo "Session created successfully. Session ID: {$sessionId}\n";

                // Get scoring results for the created session
                $sessionScoreRequest = new SessionScoreRequest($sessionId);
                $sessionScoreResponse = $sessionService->getSessionScore($sessionScoreRequest);

                if ($sessionScoreResponse) {
                    echo "Scoring Results:\n";
                    foreach ($sessionScoreResponse->questions as $question) {
                        echo "Question: {$question->id}, Marks Earned: {$question->scoring->marksEarned}, Total Marks: {$question->scoring->marksTotal}\n";
                    }
                } else {
                    echo "Failed to retrieve scoring results.\n";
                }

                // Get session info
                $sessionInfoRequest = new SessionInfoRequest($sessionId);
                $sessionInfoResponse = $sessionService->getSessionInfo($sessionInfoRequest);
                
                if ($sessionInfoResponse) {
                    echo "Session Info successfully retrieved.\n";
                } else {
                    echo "Failed to retrieve session info.\n";
                }
            } else {
                echo "Failed to create session.\n";
            }
        }
    } else {
        echo "No sessions were created.\n";
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage() . "\n";
}