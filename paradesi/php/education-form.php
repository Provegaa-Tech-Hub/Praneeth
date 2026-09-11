<?php

error_reporting(E_ALL);
ini_set('display_errors', '0');

/* =========================================================
   ABROAD EDUCATION APPLICATION
   PARADESI SOLUTIONS
   ========================================================= */

require_once __DIR__ . '/../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';
require_once __DIR__ . '/mail-config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


/* =========================================================
   EMAIL ROUTING
   ========================================================= */

$to = 'abroadsupport@paradesisolutions.com';


/* =========================================================
   ONLY ALLOW POST
   ========================================================= */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../education-application.html');
    exit;
}


/* =========================================================
   HELPER FUNCTIONS
   ========================================================= */

function clean($value)
{
    return trim((string)($value ?? ''));
}

function esc($value)
{
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        'UTF-8'
    );
}

function showMessage($title, $message, $success = false)
{
    $title = esc($title);
    $message = esc($message);

    $color = $success ? '#008000' : '#c62828';
    $buttonColor = $success ? '#0077a8' : '#555555';

    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>{$title}</title>

        <style>
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
                font-family: Arial, Helvetica, sans-serif;
                background: #f4f7fb;
            }

            .message-box {
                width: 100%;
                max-width: 650px;
                background: #ffffff;
                border-radius: 16px;
                padding: 40px 30px;
                text-align: center;
                box-shadow: 0 15px 45px rgba(0,0,0,.15);
            }

            h1 {
                color: {$color};
                margin-bottom: 15px;
            }

            p {
                color: #444;
                line-height: 1.7;
                margin-bottom: 25px;
            }

            a {
                display: inline-block;
                text-decoration: none;
                background: {$buttonColor};
                color: #ffffff;
                padding: 12px 24px;
                border-radius: 8px;
                font-weight: bold;
            }
        </style>
    </head>

    <body>

        <div class='message-box'>

            <h1>{$title}</h1>

            <p>{$message}</p>

            <a href='../education-application.html'>
                Back to Application
            </a>

        </div>

    </body>
    </html>
    ";

    exit;
}


/* =========================================================
   GET FORM DATA
   ========================================================= */

$first_name = clean($_POST['first_name'] ?? '');
$middle_name = clean($_POST['middle_name'] ?? '');
$last_name = clean($_POST['last_name'] ?? '');

$full_name = trim(
    $first_name . ' ' .
    $middle_name . ' ' .
    $last_name
);

$mobile = clean($_POST['mobile'] ?? '');
$email = clean($_POST['email'] ?? '');
$date_of_birth = clean($_POST['date_of_birth'] ?? '');
$nationality = clean($_POST['nationality'] ?? '');
$country = clean($_POST['country'] ?? '');


/* =========================================================
   AADHAAR
   ========================================================= */

$aadhaar = '';

for ($i = 1; $i <= 12; $i++) {
    $aadhaar .= clean(
        $_POST['aadhaar' . $i] ?? ''
    );
}


/* =========================================================
   PAN
   ========================================================= */

$pan = '';

for ($i = 1; $i <= 10; $i++) {
    $pan .= clean(
        $_POST['pan' . $i] ?? ''
    );
}

$pan = strtoupper($pan);


/* =========================================================
   PASSPORT
   ========================================================= */

$passport = clean(
    $_POST['passport'] ?? ''
);

$passport_from_day = clean(
    $_POST['passport_from_day'] ?? ''
);

$passport_from_month = clean(
    $_POST['passport_from_month'] ?? ''
);

$passport_from_year = clean(
    $_POST['passport_from_year'] ?? ''
);

$passport_from =
    $passport_from_day . '/' .
    $passport_from_month . '/' .
    $passport_from_year;


$passport_to_day = clean(
    $_POST['passport_to_day'] ?? ''
);

$passport_to_month = clean(
    $_POST['passport_to_month'] ?? ''
);

$passport_to_year = clean(
    $_POST['passport_to_year'] ?? ''
);

$passport_to =
    $passport_to_day . '/' .
    $passport_to_month . '/' .
    $passport_to_year;


/* =========================================================
   FAMILY DETAILS
   ========================================================= */

$about_family = clean(
    $_POST['about_family'] ?? ''
);

$mother_name = clean(
    $_POST['mother_name'] ?? ''
);

$mother_occupation = clean(
    $_POST['mother_occupation'] ?? ''
);

$mother_contact = clean(
    $_POST['mother_contact'] ?? ''
);

$father_name = clean(
    $_POST['father_name'] ?? ''
);

$father_occupation = clean(
    $_POST['father_occupation'] ?? ''
);

$father_contact = clean(
    $_POST['father_contact'] ?? ''
);

$mail_id = clean(
    $_POST['MAIL ID'] ?? ''
);


/* =========================================================
   EDUCATION DETAILS
   ========================================================= */

$present_education = clean(
    $_POST['present_education'] ?? ''
);

$preferred_education = clean(
    $_POST['preferred_education'] ?? ''
);

$present_city = clean(
    $_POST['present_city'] ?? ''
);

$preferred_country = clean(
    $_POST['preferred_country'] ?? ''
);

$education_details = clean(
    $_POST['education_details'] ?? ''
);


/* =========================================================
   VALIDATION
   ========================================================= */

if (
    $full_name === '' ||
    $mobile === '' ||
    $email === '' ||
    $date_of_birth === '' ||
    $nationality === '' ||
    $country === '' ||
    $aadhaar === '' ||
    $pan === '' ||
    $passport === ''
) {
    showMessage(
        'Required Fields Missing',
        'Please complete all required fields before submitting.',
        false
    );
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    showMessage(
        'Invalid Email',
        'Please enter a valid email address.',
        false
    );
}


/* =========================================================
   EMAIL SUBJECT
   ========================================================= */

$subject =
    'New Abroad Education Application - ' .
    ($full_name !== '' ? $full_name : 'Applicant');


/* =========================================================
   EMAIL HTML
   ========================================================= */

$message = '
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<style>

body {
    font-family: Arial, Helvetica, sans-serif;
    background: #f5f5f5;
    color: #222;
    margin: 0;
    padding: 20px;
}

.email-container {
    max-width: 800px;
    margin: auto;
    background: #ffffff;
    border: 1px solid #dddddd;
}

.email-header {
    background: #073f73;
    color: #ffffff;
    padding: 22px;
    text-align: center;
}

.email-header h2 {
    margin: 0 0 8px;
}

.email-header p {
    margin: 0;
}

.email-body {
    padding: 25px;
}

.section-title {
    background: #f0f5f9;
    padding: 11px;
    margin: 20px 0 10px;
    font-weight: bold;
    color: #073f73;
    border-left: 4px solid #073f73;
}

.info-table {
    width: 100%;
    border-collapse: collapse;
}

.info-table td {
    padding: 10px;
    border: 1px solid #eeeeee;
    vertical-align: top;
}

.info-table td:first-child {
    width: 35%;
    font-weight: bold;
    background: #fafafa;
}

</style>

</head>

<body>

<div class="email-container">

<div class="email-header">
    <h2>New Abroad Education Application</h2>
    <p>Paradesi Solutions</p>
</div>

<div class="email-body">

<div class="section-title">
    Personal Details
</div>

<table class="info-table">

<tr>
    <td>First Name</td>
    <td>' . esc($first_name) . '</td>
</tr>

<tr>
    <td>Middle Name</td>
    <td>' . esc($middle_name) . '</td>
</tr>

<tr>
    <td>Last Name</td>
    <td>' . esc($last_name) . '</td>
</tr>

<tr>
    <td>Full Name</td>
    <td>' . esc($full_name) . '</td>
</tr>

<tr>
    <td>Mobile</td>
    <td>' . esc($mobile) . '</td>
</tr>

<tr>
    <td>Email</td>
    <td>' . esc($email) . '</td>
</tr>

<tr>
    <td>Date of Birth</td>
    <td>' . esc($date_of_birth) . '</td>
</tr>

<tr>
    <td>Nationality</td>
    <td>' . esc($nationality) . '</td>
</tr>

<tr>
    <td>Country</td>
    <td>' . esc($country) . '</td>
</tr>

</table>


<div class="section-title">
    Identity & Passport Details
</div>

<table class="info-table">

<tr>
    <td>Aadhaar</td>
    <td>' . esc($aadhaar) . '</td>
</tr>

<tr>
    <td>PAN</td>
    <td>' . esc($pan) . '</td>
</tr>

<tr>
    <td>Passport Number</td>
    <td>' . esc($passport) . '</td>
</tr>

<tr>
    <td>Passport Valid From</td>
    <td>' . esc($passport_from) . '</td>
</tr>

<tr>
    <td>Passport Valid To</td>
    <td>' . esc($passport_to) . '</td>
</tr>

</table>


<div class="section-title">
    Family Details
</div>

<table class="info-table">

<tr>
    <td>About Family</td>
    <td>' . esc($about_family) . '</td>
</tr>

<tr>
    <td>Mother Name</td>
    <td>' . esc($mother_name) . '</td>
</tr>

<tr>
    <td>Mother Occupation</td>
    <td>' . esc($mother_occupation) . '</td>
</tr>

<tr>
    <td>Mother Contact</td>
    <td>' . esc($mother_contact) . '</td>
</tr>

<tr>
    <td>Father Name</td>
    <td>' . esc($father_name) . '</td>
</tr>

<tr>
    <td>Father Occupation</td>
    <td>' . esc($father_occupation) . '</td>
</tr>

<tr>
    <td>Father Contact</td>
    <td>' . esc($father_contact) . '</td>
</tr>

<tr>
    <td>MAIL ID</td>
    <td>' . esc($mail_id) . '</td>
</tr>

</table>


<div class="section-title">
    Education Details
</div>

<table class="info-table">

<tr>
    <td>Present Education</td>
    <td>' . esc($present_education) . '</td>
</tr>

<tr>
    <td>Preferred Education</td>
    <td>' . esc($preferred_education) . '</td>
</tr>

<tr>
    <td>Present City</td>
    <td>' . esc($present_city) . '</td>
</tr>

<tr>
    <td>Preferred Country</td>
    <td>' . esc($preferred_country) . '</td>
</tr>

<tr>
    <td>Education Details</td>
    <td>' . nl2br(esc($education_details)) . '</td>
</tr>

</table>

</div>

</div>

</body>
</html>
';


/* =========================================================
   CREATE PHPMailer
   ========================================================= */

$mail = new PHPMailer(true);

try {

    /* =====================================================
       WORKING SMTP CONFIGURATION
       Comes from mail-config.php
       ===================================================== */

    $mail->isSMTP();

    $mail->Host = $SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = $SMTP_USERNAME;
    $mail->Password = $SMTP_PASSWORD;
    $mail->SMTPSecure = $SMTP_SECURE;
    $mail->Port = $SMTP_PORT;

    $mail->CharSet = 'UTF-8';


    /* =====================================================
       SENDER
       ===================================================== */

    $mail->setFrom(
        $SMTP_FROM_EMAIL,
        $SMTP_FROM_NAME
    );


    /* =====================================================
       RECIPIENT
       ===================================================== */

    $mail->addAddress($to);


    /* =====================================================
       REPLY TO APPLICANT
       ===================================================== */

    $mail->addReplyTo(
        $email,
        $full_name
    );


    /* =====================================================
       EMAIL
       ===================================================== */

    $mail->isHTML(true);

    $mail->Subject = $subject;

    $mail->Body = $message;

    $mail->AltBody =
        "New Abroad Education Application\n\n" .
        "Name: " . $full_name . "\n" .
        "Mobile: " . $mobile . "\n" .
        "Email: " . $email . "\n" .
        "Date of Birth: " . $date_of_birth . "\n" .
        "Nationality: " . $nationality . "\n" .
        "Country: " . $country . "\n" .
        "Aadhaar: " . $aadhaar . "\n" .
        "PAN: " . $pan . "\n" .
        "Passport: " . $passport . "\n" .
        "Passport Valid From: " . $passport_from . "\n" .
        "Passport Valid To: " . $passport_to . "\n" .
        "Present Education: " . $present_education . "\n" .
        "Preferred Education: " . $preferred_education . "\n" .
        "Present City: " . $present_city . "\n" .
        "Preferred Country: " . $preferred_country . "\n" .
        "Education Details: " . $education_details;


/* =====================================================
   SEND
   ===================================================== */

    $mail->send();


    showMessage(
        'Application Submitted Successfully!',
        'Thank you. Your Abroad Education application has been sent successfully to our Abroad Support team.',
        true
    );


} catch (Exception $e) {

    error_log(
        'Paradesi Abroad Education mail error: ' .
        $mail->ErrorInfo
    );

    showMessage(
        'Application Could Not Be Sent',
        'There was a problem sending the Abroad Education application. Please try again later.',
        false
    );
}

?>