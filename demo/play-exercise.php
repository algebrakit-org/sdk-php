<!--
    AlgebraKit PHP SDK - Web Demo
    =============================
    This demo shows how to create an AlgebraKit exercise session using the PHP SDK
    and render it as an interactive exercise in the browser.

    Prerequisites:
    - PHP 8.0 or higher
    - Dependencies installed via `composer install`
    - A valid AlgebraKit API key (set in the configuration below)
    - A web server serving this file (e.g., `php -S localhost:8000` from the sdk-php directory)

    To run:
    1. Update $apiKey below with your AlgebraKit API key
    2. Open this file in your browser via your web server
-->

<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Algebrakit\SDK\Services\SessionService;
use Algebrakit\SDK\Models\Requests\CreateSessionRequest;
use Algebrakit\SDK\Models\Shared\ExerciseById;

// ============================================================
// CONFIGURATION - Update these values before running the demo
// ============================================================

$apiKey     = 'your-api-key-here';                  // Your AlgebraKit API key
$apiUrl     = 'https://api.algebrakit.com';          // AlgebraKit API endpoint
$widgetUrl  = 'https://widgets.algebrakit.com';      // AlgebraKit widget script URL
$exerciseId = 'fa42e943-8213-41a6-8a91-8c22a929ffe9'; // Exercise ID to create a session for

// ============================================================
// Create session using the SDK
// ============================================================

$error = null;
$exerciseHtml = null;

try {
    $sessionService = new SessionService($apiKey, null, $apiUrl);

    $response = $sessionService->createSession(
        new CreateSessionRequest(
            exercises: [new ExerciseById($exerciseId, 'latest')]
        )
    );

    if (!empty($response) && $response[0]->success && !empty($response[0]->sessions)) {
        $session = $response[0]->sessions[0];
        $exerciseHtml = $session->html;
    } else {
        $error = $response[0]->msg ?? 'Unknown error creating session';
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlgebraKit PHP SDK - Web Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }
        h1 { color: #333; }
        .error {
            background: #fee;
            border: 1px solid #c00;
            padding: 12px;
            border-radius: 4px;
            color: #900;
            margin: 20px 0;
        }
        .exercise-container {
            margin: 20px 0;
        }
    </style>
</head>
<body>

    <!-- AlgebraKit configuration (must be set BEFORE loading the widget script) -->
    <script>
        AlgebraKIT = {
            config: {
                behavior: {
                    general: {}
                }
            }
        };
    </script>

    <!-- Load AlgebraKit widget script -->
    <script src="<?= htmlspecialchars($widgetUrl) ?>"></script>

    <h1>AlgebraKit PHP SDK - Web Demo</h1>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($exerciseHtml): ?>
        <div class="exercise-container">
            <?= $exerciseHtml ?>
        </div>
    <?php endif; ?>

</body>
</html>
