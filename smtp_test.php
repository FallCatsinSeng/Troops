<?php
// Simple SMTP Connection Tester

// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('default_socket_timeout', 5); // 5 second timeout

echo "<h3>SMTP Connection Test</h3>";

$hosts = [
    'smtp.gmail.com' => [587, 465]
];

foreach ($hosts as $host => $ports) {
    foreach ($ports as $port) {
        echo "Testing connection to <strong>{$host}</strong> on port <strong>{$port}</strong>...<br>";
        
        // The '@' suppresses the initial warning, we will handle the error manually.
        $connection = @fsockopen($host, $port, $errno, $errstr, 5);

        if (is_resource($connection)) {
            echo "<span style='color:green;'>SUCCESS: Connected!</span><br>";
            
            // Read the server's welcome message
            $response = fgets($connection, 512);
            echo "Server response: " . htmlspecialchars($response) . "<br>";
            
            fclose($connection);
        } else {
            echo "<span style='color:red;'>FAILURE: Could not connect.</span><br>";
            echo "Error number: <strong>{$errno}</strong><br>";
            echo "Error message: <strong>" . htmlspecialchars($errstr) . "</strong><br>";
        }
        echo "<hr>";
    }
}

echo "<strong>Test Complete.</strong><br><br>";
echo "If all tests fail with a timeout error, it is highly likely a firewall is blocking outbound connections on these ports. You will need to contact your hosting provider for assistance."; 