<?php
/*
    AlgebraKit PHP SDK - Web Demo
    =============================
    This demo shows how to create an AlgebraKit exercise session using the PHP SDK
    and render it as an interactive exercise in the browser.

    Prerequisites:
    - PHP 8.0 or higher
    - Dependencies installed via `composer install`
    - A valid AlgebraKit API key (set in the configuration below)

    To run:
    1. Update $apiKey below with your AlgebraKit API key
    2. Start the built-in PHP server with this file as router script:
       php -S localhost:8000 demo/play-exercise.php
    3. Open http://localhost:8000 in your browser
*/

require_once __DIR__ . '/../vendor/autoload.php';

use Algebrakit\SDK\Services\SessionService;
use Algebrakit\SDK\Models\Requests\CreateSessionRequest;
use Algebrakit\SDK\Models\Shared\ExerciseById;

// ============================================================
// CONFIGURATION - Update these values before running the demo
// ============================================================

$apiKey     = 'your-api-key'; // Replace with your actual API key
$apiUrl     = 'https://api.algebrakit.com';          // AlgebraKit API endpoint
$widgetUrl  = 'https://widgets.algebrakit.com';      // AlgebraKit widget script URL
$exerciseId = 'fa42e943-8213-41a6-8a91-8c22a929ffe9'; // Exercise ID to create a session for

// ============================================================
// Proxy: forwards widget requests to the AlgebraKit API
// ============================================================

$proxyPrefix = '/proxy/algebrakit';
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (str_starts_with($requestUri, $proxyPrefix)) {
    $apiPath = substr($requestUri, strlen($proxyPrefix));
    $targetUrl = $apiUrl . $apiPath;

    $ch = curl_init($targetUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $_SERVER['REQUEST_METHOD']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: ' . ($_SERVER['CONTENT_TYPE'] ?? 'application/json'),
        'x-api-key: ' . $apiKey,
    ]);

    if ($_SERVER['REQUEST_METHOD'] !== 'GET' && $_SERVER['REQUEST_METHOD'] !== 'HEAD') {
        curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents('php://input'));
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    curl_close($ch);

    $body = substr($response, $headerSize);
    http_response_code($httpCode);
    header('Content-Type: application/json');
    echo $body;
    exit;
}

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
        #event-log {
            margin-top: 40px;
            border: 1px solid #ccc;
            border-radius: 4px;
            max-height: 400px;
            overflow-y: auto;
            font-family: monospace;
            font-size: 13px;
        }
        #event-log h2 {
            margin: 0;
            padding: 10px 12px;
            font-size: 14px;
            background: #f5f5f5;
            border-bottom: 1px solid #ccc;
            position: sticky;
            top: 0;
        }
        .event-entry {
            border-bottom: 1px solid #eee;
        }
        .event-entry:last-child {
            border-bottom: none;
        }
        .event-header {
            padding: 8px 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .event-header:hover {
            background: #f9f9f9;
        }
        .event-toggle {
            display: inline-block;
            width: 16px;
            margin-right: 6px;
            color: #999;
            font-size: 11px;
        }
        .event-name {
            font-weight: bold;
            color: #0066cc;
        }
        .event-time {
            color: #999;
            margin-left: 8px;
        }
        .event-data {
            padding: 4px 12px 8px 34px;
            color: #555;
            white-space: pre-wrap;
            word-break: break-all;
            display: none;
        }
        .event-entry.expanded .event-data {
            display: block;
        }
        .event-entry.expanded .event-toggle {
            transform: rotate(90deg);
        }
    </style>
</head>
<body>

    <!-- AlgebraKit configuration (must be set BEFORE loading the widget script) -->
    <script>
        AlgebraKIT = {
            config: {
                proxy: {
                    url: '<?= $proxyPrefix ?>'
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

    <div id="event-log">
        <h2>Learning Events</h2>
    </div>

    <script>
        AlgebraKIT.addExerciseListener(function (evt) {
            var log = document.getElementById('event-log');
            var entry = document.createElement('div');
            entry.className = 'event-entry';

            var time = new Date().toLocaleTimeString();
            var dataObj = Object.assign({}, evt);
            delete dataObj.event;
            var dataStr = JSON.stringify(dataObj, null, 2);

            entry.innerHTML =
                '<div class="event-header" onclick="this.parentElement.classList.toggle(\'expanded\')">' +
                    '<span class="event-toggle">&#9654;</span>' +
                    '<span class="event-name">' + evt.event + '</span>' +
                    '<span class="event-time">' + time + '</span>' +
                '</div>' +
                '<div class="event-data">' + dataStr + '</div>';

            log.appendChild(entry);
            log.scrollTop = log.scrollHeight;
        });
    </script>

</body>
</html>
