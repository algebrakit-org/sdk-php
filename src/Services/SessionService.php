<?php

namespace Algebrakit\SDK\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Algebrakit\SDK\Models\Requests\CreateSessionRequest;
use Algebrakit\SDK\Models\Requests\SessionScoreRequest;
use Algebrakit\SDK\Models\Requests\SessionInfoRequest;
use Algebrakit\SDK\Models\Requests\SessionRetrieveRequest;
use Algebrakit\SDK\Models\Requests\SessionLockRequest;
use Algebrakit\SDK\Models\Requests\ExerciseValidateRequest;
use Algebrakit\SDK\Models\Requests\ExerciseInfoRequest;
use Algebrakit\SDK\Models\Responses\CreateSessionResponse;
use Algebrakit\SDK\Models\Responses\SessionScoreResponse;
use Algebrakit\SDK\Models\Responses\SessionInfoResponse;
use Algebrakit\SDK\Models\Responses\SessionRetrieveResponse;
use Algebrakit\SDK\Models\Responses\SessionLockResponse;
use Algebrakit\SDK\Models\Responses\ExerciseValidateResponse;
use Algebrakit\SDK\Models\Responses\ExerciseInfoResponse;
use RuntimeException;

class SessionService
{
    private Client $httpClient;
    private string $apiKey;

    public function __construct(string $apiKey, ?Client $httpClient = null, string $baseUrl = 'https://api.algebrakit.com')
    {
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient ?? new Client([
            'base_uri' => $baseUrl,
            'headers' => [
                'X-API-KEY' => $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
    }

    /**
     * Creates new exercise sessions.
     * 
     * @param CreateSessionRequest $request The request containing session details
     * @return array Array of CreateSessionResponse objects
     * @throws RuntimeException If the request fails
     */
    public function createSession(CreateSessionRequest $request): array
    {
        try {
            $response = $this->httpClient->post('/session/create', [
                'json' => $request->jsonSerialize()
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException('Failed to decode JSON response: ' . json_last_error_msg());
            }

            $results = [];
            foreach ($data as $item) {
                $results[] = CreateSessionResponse::fromArray($item);
            }

            return $results;
        } catch (GuzzleException $e) {
            throw new RuntimeException('Failed to create session: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Retrieves scores for a specific session.
     * 
     * @param SessionScoreRequest $request The request containing session ID and lock option
     * @return SessionScoreResponse The response containing session scores
     * @throws RuntimeException If the request fails
     */
    public function getSessionScore(SessionScoreRequest $request): SessionScoreResponse
    {
        try {
            $response = $this->httpClient->post('/session/score', [
                'json' => $request->jsonSerialize()
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException('Failed to decode JSON response: ' . json_last_error_msg());
            }

            return SessionScoreResponse::fromArray($data);
        } catch (GuzzleException $e) {
            throw new RuntimeException('Failed to get session score: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Locks or unlocks exercise sessions.
     * 
     * @param SessionLockRequest $request The request containing session IDs and action
     * @return SessionLockResponse The response for the lock or unlock action
     * @throws RuntimeException If the request fails
     */
    public function lockOrUnlockSession(SessionLockRequest $request): SessionLockResponse
    {
        try {
            $response = $this->httpClient->post('/session/lock', [
                'json' => $request->jsonSerialize()
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException('Failed to decode JSON response: ' . json_last_error_msg());
            }

            return SessionLockResponse::fromArray($data);
        } catch (GuzzleException $e) {
            throw new RuntimeException('Failed to lock/unlock session: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Retrieves information for a specific session.
     * 
     * @param SessionInfoRequest $request The request containing session ID
     * @return SessionInfoResponse The response containing session information
     * @throws RuntimeException If the request fails
     */
    public function getSessionInfo(SessionInfoRequest $request): SessionInfoResponse
    {
        try {
            $response = $this->httpClient->post('/session/info', [
                'json' => $request->jsonSerialize()
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException('Failed to decode JSON response: ' . json_last_error_msg());
            }

            return SessionInfoResponse::fromArray($data);
        } catch (GuzzleException $e) {
            throw new RuntimeException('Failed to get session info: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Retrieves existing sessions by their IDs.
     * 
     * @param SessionRetrieveRequest $request The request containing session IDs
     * @return SessionRetrieveResponse The response containing session data
     * @throws RuntimeException If the request fails
     */
    public function retrieveSessions(SessionRetrieveRequest $request): SessionRetrieveResponse
    {
        try {
            $response = $this->httpClient->post('/session/retrieve', [
                'json' => $request->jsonSerialize()
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException('Failed to decode JSON response: ' . json_last_error_msg());
            }

            return SessionRetrieveResponse::fromArray($data);
        } catch (GuzzleException $e) {
            throw new RuntimeException('Failed to retrieve sessions: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Validates an exercise.
     * 
     * @param ExerciseValidateRequest $request The request containing exercise details
     * @return ExerciseValidateResponse The response containing validation results
     * @throws RuntimeException If the request fails
     */
    public function validateExercise(ExerciseValidateRequest $request): ExerciseValidateResponse
    {
        try {
            $response = $this->httpClient->post('/exercise/validate', [
                'json' => $request->jsonSerialize()
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException('Failed to decode JSON response: ' . json_last_error_msg());
            }

            return ExerciseValidateResponse::fromArray($data);
        } catch (GuzzleException $e) {
            throw new RuntimeException('Failed to validate exercise: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Retrieves published information about an exercise.
     * 
     * @param ExerciseInfoRequest $request The request containing exercise ID
     * @return ExerciseInfoResponse The response containing exercise information
     * @throws RuntimeException If the request fails
     */
    public function getExerciseInfo(ExerciseInfoRequest $request): ExerciseInfoResponse
    {
        try {
            $response = $this->httpClient->post('/exercise/published-info', [
                'json' => $request->jsonSerialize()
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new RuntimeException('Failed to decode JSON response: ' . json_last_error_msg());
            }

            return ExerciseInfoResponse::fromArray($data);
        } catch (GuzzleException $e) {
            throw new RuntimeException('Failed to get exercise info: ' . $e->getMessage(), 0, $e);
        }
    }
}