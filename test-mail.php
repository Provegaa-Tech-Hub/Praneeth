<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/php/mail-config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();

    // SMTP debugging - temporarily enabled for testing
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';

    $mail->Host = $SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = $SMTP_USERNAME;
    $mail->Password = $SMTP_PASSWORD;
    $mail->SMTPSecure = $SMTP_SECURE;
    $mail->Port = $SMTP_PORT;
    $mail->CharSet = 'UTF-8';

    $mail->setFrom($SMTP_FROM_EMAIL, $SMTP_FROM_NAME);
    $mail->addAddress('info@paradesisolutions.com');

    $mail->Subject = 'Paradesi Solutions - SMTP Test';

    $mail->isHTML(true);
    $mail->Body = '
        <h2>Paradesi Solutions SMTP Test</h2>
        <p>This is a test email from the Paradesi Solutions website.</p>
        <p><strong>SMTP connection is working successfully.</strong></p>
    ';

    $mail->AltBody =
        "Paradesi Solutions SMTP Test\n\n" .
        "This is a test email from the Paradesi Solutions website.";

    $mail->send();

    echo '<hr>';
    echo '<strong>SMTP TEST SUCCESS:</strong> Email sent to info@paradesisolutions.com';

} catch (Exception $e) {

    http_response_code(500);

    echo '<hr>';
    echo '<strong>SMTP TEST FAILED:</strong><br>';
    echo htmlspecialchars($mail->ErrorInfo, ENT_QUOTES, 'UTF-8');
}
?>