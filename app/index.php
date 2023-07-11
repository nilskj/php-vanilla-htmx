<?php
$viewDir = '/views/';
$logDir = '/logs/';
$route = $_SERVER['REQUEST_URI'];
$hxRequest = isset($_SERVER['HTTP_HX_REQUEST']) && $_SERVER['HTTP_HX_REQUEST'] == 'true';

register_shutdown_function(function () {
    global $content, $hxRequest, $viewDir;
    if ($hxRequest) {
        echo $content;
    } else {
        require __DIR__ . $viewDir . '_layout.php';
    }
});

function exception_handler($throwable): void
{
    global $content, $logDir;
    $logFile = __DIR__ . $logDir . '/error_log.txt';
    $message = date('Y-m-d H:i:s') . ' - Error: ' . $throwable->getMessage() . ' in ' . $throwable->getFile() . ' on line ' . $throwable->getLine() . PHP_EOL;
    file_put_contents($logFile, $message, FILE_APPEND);
    $content = "An unexpected error occurred. Please check the logs for more information." . PHP_EOL;
}
set_exception_handler('exception_handler');

function get_sqlite_connection(): ?PDO
{
    $sqlite_file = __DIR__ . '/database.sqlite';
    try {
        $conn = new PDO("sqlite:" . $sqlite_file);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $exception) {
        exception_handler($exception);
        return null;
    }
}

ob_start();
switch ($route) {
    case '':
    case '/':
        require __DIR__ . $viewDir . 'home.php';
        break;

    case '/about':
        require __DIR__ . $viewDir . 'about.php';
        break;

    case '/htmx':
        echo '<p>hello</p>';
        break;

    default:
        http_response_code(404);
        require __DIR__ . $viewDir . '404.php';
}
$content = ob_get_clean();