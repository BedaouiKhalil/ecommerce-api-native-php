<?php
require 'vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

echo "<h2>Testing Email Configuration</h2>";

// Verify all required environment variables are set
$requiredVars = ['MAIL_HOST', 'MAIL_PORT', 'MAIL_USERNAME', 'MAIL_PASSWORD', 'MAIL_FROM', 'MAIL_FROM_NAME'];
foreach ($requiredVars as $var) {
    if (!isset($_ENV[$var])) {
        die("<div style='color:red'>Error: Required environment variable $var is missing!</div>");
    }
}

// 1. Display configuration
echo "<h3>1. Current Configuration</h3>";
echo "<pre>";
echo "MAIL_HOST: " . $_ENV['MAIL_HOST'] . "\n";
echo "MAIL_PORT: " . $_ENV['MAIL_PORT'] . "\n";
echo "MAIL_USERNAME: " . $_ENV['MAIL_USERNAME'] . "\n";
echo "MAIL_PASSWORD: " . (!empty($_ENV['MAIL_PASSWORD']) ? '*****' : 'NOT SET') . "\n";
echo "MAIL_FROM: " . $_ENV['MAIL_FROM'] . "\n";
echo "MAIL_FROM_NAME: " . $_ENV['MAIL_FROM_NAME'] . "\n";
echo "</pre>";

// 2. Test SMTP connection
echo "<h3>2. Testing SMTP Connection</h3>";

$mail = new PHPMailer(true);

try {
    // Enable verbose debug output
    $mail->SMTPDebug = SMTP::DEBUG_CONNECTION;
    
    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host = $_ENV['MAIL_HOST'];
    $mail->Port = $_ENV['MAIL_PORT'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['MAIL_USERNAME'];
    $mail->Password = $_ENV['MAIL_PASSWORD'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->AuthType = 'LOGIN'; // Force LOGIN authentication
    
    // Test connection
    echo "Attempting to connect...<br>";
    if (!$mail->smtpConnect()) {
        throw new Exception('SMTP connect failed');
    }
    echo "<span style='color:green'>SMTP connection successful!</span><br>";
    $mail->smtpClose();
    
} catch (Exception $e) {
    echo "<div style='color:red'><strong>Error:</strong> " . $e->getMessage() . "</div>";
    echo "SMTP error details: " . $mail->ErrorInfo . "<br>";
}

// 3. Test sending email
echo "<h3>3. Testing Email Send</h3>";

try {
    $mail->clearAddresses();
    $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME']);
    $mail->addAddress($_ENV['MAIL_FROM']); // Send to yourself
    $mail->Subject = 'Test Email';
    $mail->Body = 'This is a test email from your application.';
    
    echo "Attempting to send test email...<br>";
    if ($mail->send()) {
        echo "<div style='color:green'><strong>Email sent successfully!</strong></div>";
    } else {
        echo "<div style='color:red'><strong>Failed to send email</strong></div>";
        echo "Error details: " . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "<div style='color:red'><strong>Error sending email:</strong> " . $e->getMessage() . "</div>";
}