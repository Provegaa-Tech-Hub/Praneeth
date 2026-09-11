<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');

require_once __DIR__ . '/../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';
require_once __DIR__ . '/mail-config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Invalid request.');
}

function cleanText($value) {
    return trim((string)($value ?? ''));
}

function esc($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

// Get form data
$name = cleanText($_POST['name'] ?? '');
$email = cleanText($_POST['email'] ?? '');
$phone = cleanText($_POST['phone'] ?? '');
$subjectText = cleanText($_POST['subject'] ?? '');
$messageText = cleanText($_POST['message'] ?? '');

// Validate required fields
if ($name === '' || $email === '' || $phone === '' || $subjectText === '') {
    exit('Please fill in all required fields.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit('Please enter a valid email address.');
}

// Create PHPMailer
$mail = new PHPMailer(true);

try {

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = $SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = $SMTP_USERNAME;
    $mail->Password = $SMTP_PASSWORD;
    $mail->SMTPSecure = $SMTP_SECURE;
    $mail->Port = $SMTP_PORT;

    $mail->CharSet = 'UTF-8';

    // Sender
    $mail->setFrom(
        $SMTP_FROM_EMAIL,
        $SMTP_FROM_NAME
    );

    // Send Let's Talk enquiries to:
    $mail->addAddress('info@paradesisolutions.com');

    // Customer email becomes Reply-To
    $mail->addReplyTo($email, $name);

    // Email format
    $mail->isHTML(true);

    $mail->Subject = "New Let's Talk Enquiry - " . $subjectText;

    // HTML email
    $mail->Body =
        '<div style="font-family:Arial,sans-serif;max-width:750px;margin:auto;border:1px solid #ddd;background:#fff">'

        . '<div style="background:#073f73;color:#fff;padding:20px;text-align:center">'
        . '<h2 style="margin:0">New Let\'s Talk Enquiry</h2>'
        . '<p>Paradesi Solutions</p>'
        . '</div>'

        . '<div style="padding:25px">'

        . '<table style="width:100%;border-collapse:collapse">'

        . '<tr>'
        . '<td style="padding:10px;border-bottom:1px solid #eee;font-weight:bold;width:35%">Name</td>'
        . '<td style="padding:10px;border-bottom:1px solid #eee">'
        . esc($name)
        . '</td>'
        . '</tr>'

        . '<tr>'
        . '<td style="padding:10px;border-bottom:1px solid #eee;font-weight:bold">Email ID</td>'
        . '<td style="padding:10px;border-bottom:1px solid #eee">'
        . esc($email)
        . '</td>'
        . '</tr>'

        . '<tr>'
        . '<td style="padding:10px;border-bottom:1px solid #eee;font-weight:bold">Phone</td>'
        . '<td style="padding:10px;border-bottom:1px solid #eee">'
        . esc($phone)
        . '</td>'
        . '</tr>'

        . '<tr>'
        . '<td style="padding:10px;border-bottom:1px solid #eee;font-weight:bold">Subject</td>'
        . '<td style="padding:10px;border-bottom:1px solid #eee">'
        . esc($subjectText)
        . '</td>'
        . '</tr>'

        . '</table>'

        . '<h3 style="color:#073f73;margin-top:25px">Message</h3>'

        . '<div style="padding:15px;background:#f7f7f7;white-space:pre-wrap">'
        . nl2br(
            esc(
                $messageText !== ''
                    ? $messageText
                    : 'No message provided.'
            )
        )
        . '</div>'

        . '</div>'
        . '</div>';

    // Plain-text version
    $mail->AltBody =
        "New Let's Talk Enquiry\n\n"
        . "Name: " . $name . "\n"
        . "Email: " . $email . "\n"
        . "Phone: " . $phone . "\n"
        . "Subject: " . $subjectText . "\n\n"
        . "Message:\n"
        . ($messageText !== '' ? $messageText : 'No message provided.');

    // Send email
    $mail->send();

    // Success
    echo '<script>
        alert("Thank you! Your enquiry has been submitted successfully.");
        window.location.href="../WEBSITE.html";
    </script>';

} catch (Exception $e) {

    // Log error on server
    error_log(
        "Paradesi Let's Talk mail error: "
        . $mail->ErrorInfo
    );

    http_response_code(500);

    exit(
        'Sorry, your enquiry could not be sent. Please try again later.'
    );
}
?>