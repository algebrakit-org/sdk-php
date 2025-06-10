# Algebrakit PHP SDK

A PHP SDK for interacting with the Algebrakit Web Service API.

## Installation

Install the SDK using Composer:

```bash
composer install
```

## Requirements

- PHP 8.0 or higher
- Guzzle HTTP client

## Usage

### Basic Setup

```php
<?php

require_once 'vendor/autoload.php';

use Algebrakit\SDK\Services\SessionService;
use Algebrakit\SDK\Models\Requests\CreateSessionRequest;
use Algebrakit\SDK\Models\Shared\ExerciseById;

// Initialize the SessionService with your API key
$apiKey = 'your-api-key-here';
$sessionService = new SessionService($apiKey);
```

### Creating a Session

```php
// Create a session for an exercise
$createSessionRequest = new CreateSessionRequest(
    exercises: [new ExerciseById('your-exercise-id', 'latest')]
);

$createSessionResponse = $sessionService->createSession($createSessionRequest);

foreach ($createSessionResponse as $response) {
    if ($response->success && !empty($response->sessions)) {
        $session = $response->sessions[0];
        echo "Session created: " . $session->sessionId . "\n";
    }
}
```

### Getting Session Scores

```php
use Algebrakit\SDK\Models\Requests\SessionScoreRequest;

$sessionScoreRequest = new SessionScoreRequest('your-session-id');
$sessionScoreResponse = $sessionService->getSessionScore($sessionScoreRequest);

foreach ($sessionScoreResponse->questions as $question) {
    echo "Question: {$question->id}, Marks: {$question->scoring->marksEarned}/{$question->scoring->marksTotal}\n";
}
```

### Validating an Exercise

```php
use Algebrakit\SDK\Models\Requests\ExerciseValidateRequest;

$validateRequest = new ExerciseValidateRequest(exerciseId: 'your-exercise-id');
$validateResponse = $sessionService->validateExercise($validateRequest);

echo "Exercise valid: " . ($validateResponse->valid ? 'Yes' : 'No') . "\n";
```

## Running the Demo

1. Install dependencies:
   ```bash
   composer install
   ```

2. Update the API key in `demo/demo.php`:
   ```php
   $apiKey = 'your-actual-api-key';
   ```

3. Run the demo:
   ```bash
   php demo/demo.php
   ```

## API Reference

### SessionService Methods

- `createSession(CreateSessionRequest $request): array` - Create new exercise sessions
- `getSessionScore(SessionScoreRequest $request): SessionScoreResponse` - Get session scoring results
- `getSessionInfo(SessionInfoRequest $request): SessionInfoResponse` - Get detailed session information
- `retrieveSessions(SessionRetrieveRequest $request): SessionRetrieveResponse` - Retrieve existing sessions
- `lockOrUnlockSession(SessionLockRequest $request): SessionLockResponse` - Lock or unlock sessions
- `validateExercise(ExerciseValidateRequest $request): ExerciseValidateResponse` - Validate an exercise
- `getExerciseInfo(ExerciseInfoRequest $request): ExerciseInfoResponse` - Get exercise information

### Exercise Types

You can specify exercises in three ways:

1. **By Exercise ID**:
   ```php
   new ExerciseById('exercise-id', 'latest')
   ```

2. **By Exercise Specification**:
   ```php
   new ExerciseBySpec($exerciseSpecObject)
   ```

3. **By Session ID** (reuse exercise from existing session):
   ```php
   new ExerciseBySession('existing-session-id')
   ```

## Error Handling

All service methods throw `RuntimeException` if the API request fails:

```php
try {
    $response = $sessionService->createSession($request);
} catch (RuntimeException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
```

## License

MIT License