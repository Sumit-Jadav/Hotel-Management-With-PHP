<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/vendor/autoload.php';

use PhonePe\Env;
use PhonePe\payments\v1\models\request\builders\InstrumentBuilder;
use PhonePe\payments\v1\models\request\builders\PgPayRequestBuilder;
use PhonePe\payments\v1\PhonePePaymentClient;

try {
    // Ensure POST method
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405); // Method Not Allowed
        throw new Exception('Only POST requests are allowed.');
    }

    // Get raw POST data
    $postData = file_get_contents('php://input');
    if (empty($postData)) {
        http_response_code(400); // Bad Request
        throw new Exception('No POST data received.');
    }

    // Create log directory if it doesn't exist
    $logsDir = __DIR__ . '/logs';
    if (!is_dir($logsDir)) {
        if (!mkdir($logsDir, 0755, true)) {
            throw new Exception('Failed to create log directory.');
        }
    }

    // Log file
    $logFile = $logsDir . '/log_' . date('Y-m-d') . '.log';

    // Log received data
    $logEntry = '[' . date('Y-m-d H:i:s') . '] Received Data: ' . $postData . PHP_EOL;
    file_put_contents($logFile, $logEntry, FILE_APPEND);

    // Check for x-verify header
    if (!isset($_SERVER['HTTP_X_VERIFY'])) {
        http_response_code(400); // Bad Request
        throw new Exception('Missing x-verify header.');
    }

    $xVerify = $_SERVER['HTTP_X_VERIFY'];

    // PhonePe Payment Client initialization
    try {
        $phonePePaymentsClient = new PhonePePaymentClient(API_MERCHAT_ID, API_KEY, API_KEY_INDEX, ENV, true);
    } catch (Exception $e) {
        throw new Exception('Failed to initialize PhonePePaymentClient: ' . $e->getMessage());
    }

    // Verify the callback signature
    try {
        $postData = json_decode($postData, true);
        $isValid = $phonePePaymentsClient->verifyCallback($postData['response'], $xVerify);
    } catch (Exception $e) {
        throw new Exception('Error during signature verification: ' . $e->getMessage());
    }

    // Log verification result
    $logEntry = '[' . date('Y-m-d H:i:s') . '] Verification: ' . ($isValid ? 'Success' : 'Failed') . PHP_EOL;
    file_put_contents($logFile, $logEntry, FILE_APPEND);

    // Handle verification result
    if ($isValid) {
        // Signature valid, process the data
        echo json_encode(['status' => 'success', 'message' => 'Data verified and logged successfully.']);
    } else {
        http_response_code(400); // Bad Request
        throw new Exception('Invalid signature.');
    }
} catch (Exception $e) {
    $logEntry = '[' . date('Y-m-d H:i:s') . '] Error: ' . $e->getMessage() . PHP_EOL;
    if(!empty($logFile)){
        file_put_contents($logFile, $logEntry, FILE_APPEND);
    }
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
