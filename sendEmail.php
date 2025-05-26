<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Enable verbose debugging (remove in production)
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        
        // Configuration SMTP Mailtrap
        $mail->isSMTP();
        $mail->Host       = $_ENV['MAIL_HOST'] ?? 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['MAIL_USERNAME'] ?? '';
        $mail->Password   = $_ENV['MAIL_PASSWORD'] ?? '';
        $mail->Port       = $_ENV['MAIL_PORT'] ?? 2525;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Timeout    = 10;

        // Validate credentials are set
        if (empty($mail->Username) || empty($mail->Password)) {
            throw new Exception('Mail credentials not configured in .env file');
        }

        // Validate email parameters
        if (empty($to) || !filter_var($to, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid recipient email address');
        }

        // Set sender information with proper validation
        $fromEmail = $_ENV['MAIL_FROM'] ?? 'noreply@example.com';
        $fromName = $_ENV['MAIL_FROM_NAME'] ?? 'Support Team';
        
        if (!filter_var($fromEmail, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid sender email address in MAIL_FROM');
        }
        
        $mail->setFrom($fromEmail, $fromName);
        $mail->addAddress($to);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);
        $mail->CharSet = 'UTF-8'; // Ensure proper encoding

        // Actually send the email
        if (!$mail->send()) {
            throw new Exception($mail->ErrorInfo);
        }
        
        return [
            'status' => 'success', 
            'message' => 'Email sent successfully'
        ];
        
    } catch (Exception $e) {
        return [
            'status' => 'failure',
            'message' => 'Email sending failed: ' . $e->getMessage(),
        ];
    }
}
