<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');

require_once __DIR__ . '/../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';
require_once __DIR__ . '/mail-config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


/* =========================================================
   INDIAN IT JOB APPLICATION
   Recipient: careers@paradesisolutions.com
   ========================================================= */

$recipient = 'careers@paradesisolutions.com';


/* =========================================================
   POST REQUEST ONLY
   ========================================================= */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Invalid request.');
}


/* =========================================================
   HELPER FUNCTIONS
   ========================================================= */

function cleanText($value)
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


/* =========================================================
   GET FORM DATA
   ========================================================= */

$first_name = cleanText($_POST['first_name'] ?? '');
$middle_name = cleanText($_POST['middle_name'] ?? '');
$last_name = cleanText($_POST['last_name'] ?? '');

$full_name = trim(
    $first_name . ' ' .
    $middle_name . ' ' .
    $last_name
);

$birth_date = cleanText($_POST['birth_date'] ?? '');
$pan = cleanText($_POST['pan'] ?? '');
$aadhaar = cleanText($_POST['aadhaar'] ?? '');

$email = cleanText($_POST['email'] ?? '');
$phone = cleanText($_POST['phone'] ?? '');

$job_category = cleanText($_POST['job_category'] ?? '');
$job_position = cleanText($_POST['job_position'] ?? '');
$skills = cleanText($_POST['skills'] ?? '');

$qualification = cleanText($_POST['qualification'] ?? '');
$experience = cleanText($_POST['experience'] ?? '');

$current_ctc = cleanText($_POST['current_ctc'] ?? '');
$expected_ctc = cleanText($_POST['expected_ctc'] ?? '');

$notice_period = cleanText($_POST['notice_period'] ?? '');
$current_location = cleanText($_POST['current_location'] ?? '');

$preferred_location = cleanText($_POST['preferred_location'] ?? '');
$employment_type = cleanText($_POST['employment_type'] ?? '');


/* =========================================================
   VALIDATION
   ========================================================= */

if (
    $first_name === '' ||
    $last_name === '' ||
    $birth_date === '' ||
    $pan === '' ||
    $aadhaar === '' ||
    $email === '' ||
    $phone === '' ||
    $job_position === '' ||
    $skills === '' ||
    $current_ctc === '' ||
    $expected_ctc === '' ||
    $notice_period === '' ||
    $current_location === '' ||
    $preferred_location === '' ||
    $employment_type === ''
) {
    http_response_code(400);
    exit('Please fill in all required fields.');
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    exit('Please enter a valid email address.');
}


/* =========================================================
   RESUME VALIDATION
   ========================================================= */

if (
    !isset($_FILES['resume']) ||
    $_FILES['resume']['error'] !== UPLOAD_ERR_OK
) {
    http_response_code(400);
    exit('Please upload your resume.');
}

$resume = $_FILES['resume'];

$maxFileSize = 10 * 1024 * 1024; // 10 MB

if ($resume['size'] > $maxFileSize) {
    http_response_code(400);
    exit('Resume file must be smaller than 10 MB.');
}


$allowedExtensions = [
    'pdf',
    'doc',
    'docx'
];

$originalFileName = basename($resume['name']);

$fileExtension = strtolower(
    pathinfo(
        $originalFileName,
        PATHINFO_EXTENSION
    )
);

if (!in_array($fileExtension, $allowedExtensions, true)) {
    http_response_code(400);
    exit('Only PDF, DOC and DOCX resume files are allowed.');
}


/* =========================================================
   EMAIL SUBJECT
   ========================================================= */

$subject =
    'New Indian IT Job Application - ' .
    $full_name;


/* =========================================================
   HTML EMAIL
   ========================================================= */

$body = '
<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<style>

body {
    margin: 0;
    padding: 20px;
    background: #f5f5f5;
    font-family: Arial, Helvetica, sans-serif;
    color: #222;
}

.container {
    max-width: 800px;
    margin: auto;
    background: #ffffff;
    border: 1px solid #dddddd;
}

.header {
    background: #073f73;
    color: #ffffff;
    padding: 22px;
    text-align: center;
}

.header h2 {
    margin: 0 0 8px;
}

.header p {
    margin: 0;
}

.content {
    padding: 25px;
}

.section {
    margin-top: 22px;
}

.section-title {
    background: #f0f5f9;
    color: #073f73;
    font-weight: bold;
    padding: 11px;
    border-left: 4px solid #073f73;
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

td {
    padding: 10px;
    border: 1px solid #eeeeee;
    vertical-align: top;
}

td:first-child {
    width: 35%;
    font-weight: bold;
    background: #fafafa;
}

</style>

</head>

<body>

<div class="container">

    <div class="header">

        <h2>New Indian IT Job Application</h2>

        <p>Paradesi Solutions</p>

    </div>


    <div class="content">


        <div class="section">

            <div class="section-title">
                Personal Details
            </div>

            <table>

                <tr>
                    <td>Full Name</td>
                    <td>' . esc($full_name) . '</td>
                </tr>

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
                    <td>Birth Date</td>
                    <td>' . esc($birth_date) . '</td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td>' . esc($email) . '</td>
                </tr>

                <tr>
                    <td>Phone</td>
                    <td>' . esc($phone) . '</td>
                </tr>

            </table>

        </div>


        <div class="section">

            <div class="section-title">
                Identity Details
            </div>

            <table>

                <tr>
                    <td>PAN</td>
                    <td>' . esc($pan) . '</td>
                </tr>

                <tr>
                    <td>Aadhaar</td>
                    <td>' . esc($aadhaar) . '</td>
                </tr>

            </table>

        </div>


        <div class="section">

            <div class="section-title">
                Job Details
            </div>

            <table>

                <tr>
                    <td>Job Category</td>
                    <td>' . esc($job_category) . '</td>
                </tr>

                <tr>
                    <td>Job Position</td>
                    <td>' . esc($job_position) . '</td>
                </tr>

                <tr>
                    <td>Skills / Job Title</td>
                    <td>' . esc($skills) . '</td>
                </tr>

                <tr>
                    <td>Highest Qualification</td>
                    <td>' . esc($qualification) . '</td>
                </tr>

                <tr>
                    <td>Experience</td>
                    <td>' . esc($experience) . '</td>
                </tr>

            </table>

        </div>


        <div class="section">

            <div class="section-title">
                Salary Details
            </div>

            <table>

                <tr>
                    <td>Current CTC</td>
                    <td>' . esc($current_ctc) . '</td>
                </tr>

                <tr>
                    <td>Expected CTC</td>
                    <td>' . esc($expected_ctc) . '</td>
                </tr>

            </table>

        </div>


        <div class="section">

            <div class="section-title">
                Employment Details
            </div>

            <table>

                <tr>
                    <td>Notice Period</td>
                    <td>' . esc($notice_period) . '</td>
                </tr>

                <tr>
                    <td>Current Location</td>
                    <td>' . esc($current_location) . '</td>
                </tr>

                <tr>
                    <td>Preferred Job Location</td>
                    <td>' . esc($preferred_location) . '</td>
                </tr>

                <tr>
                    <td>Employment Type</td>
                    <td>' . esc($employment_type) . '</td>
                </tr>

            </table>

        </div>


        <div class="section">

            <div class="section-title">
                Resume
            </div>

            <table>

                <tr>
                    <td>Uploaded Resume</td>
                    <td>' . esc($originalFileName) . '</td>
                </tr>

            </table>

        </div>


    </div>

</div>

</body>

</html>
';


/* =========================================================
   CREATE MAIL
   ========================================================= */

$mail = new PHPMailer(true);

try {

    /* =====================================================
       WORKING SMTP CONFIGURATION
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
       FROM
       ===================================================== */

    $mail->setFrom(
        $SMTP_FROM_EMAIL,
        $SMTP_FROM_NAME
    );


    /* =====================================================
       TO
       ===================================================== */

    $mail->addAddress(
        $recipient
    );


    /* =====================================================
       REPLY TO APPLICANT
       ===================================================== */

    $mail->addReplyTo(
        $email,
        $full_name
    );


    /* =====================================================
       EMAIL CONTENT
       ===================================================== */

    $mail->isHTML(true);

    $mail->Subject = $subject;

    $mail->Body = $body;


    /* =====================================================
       PLAIN TEXT
       ===================================================== */

    $mail->AltBody =
        "New Indian IT Job Application\n\n" .

        "Full Name: " . $full_name . "\n" .
        "Birth Date: " . $birth_date . "\n" .
        "PAN: " . $pan . "\n" .
        "Aadhaar: " . $aadhaar . "\n" .
        "Email: " . $email . "\n" .
        "Phone: " . $phone . "\n" .

        "Job Category: " . $job_category . "\n" .
        "Job Position: " . $job_position . "\n" .
        "Skills: " . $skills . "\n" .
        "Qualification: " . $qualification . "\n" .
        "Experience: " . $experience . "\n" .

        "Current CTC: " . $current_ctc . "\n" .
        "Expected CTC: " . $expected_ctc . "\n" .

        "Notice Period: " . $notice_period . "\n" .
        "Current Location: " . $current_location . "\n" .
        "Preferred Location: " . $preferred_location . "\n" .
        "Employment Type: " . $employment_type;


/* =====================================================
   ATTACH RESUME
   ===================================================== */

    $mail->addAttachment(
        $resume['tmp_name'],
        $originalFileName
    );


/* =====================================================
   SEND
   ===================================================== */

    $mail->send();


/* =====================================================
   SUCCESS
   ===================================================== */

    echo '
    <!DOCTYPE html>

    <html>

    <head>

        <meta charset="UTF-8">

        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
        >

        <title>Application Submitted</title>

        <style>

            body {
                margin: 0;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                font-family: Arial, sans-serif;
                background: #f4f7fb;
                padding: 20px;
            }

            .box {
                max-width: 600px;
                width: 100%;
                background: white;
                padding: 45px 30px;
                border-radius: 15px;
                text-align: center;
                box-shadow: 0 15px 40px rgba(0,0,0,.15);
            }

            h1 {
                color: #008000;
            }

            p {
                color: #555;
                line-height: 1.7;
            }

            a {
                display: inline-block;
                margin-top: 15px;
                padding: 13px 25px;
                background: #0077b6;
                color: white;
                text-decoration: none;
                border-radius: 7px;
                font-weight: bold;
            }

        </style>

    </head>

    <body>

        <div class="box">

            <h1>Application Submitted Successfully!</h1>

            <p>
                Thank you for applying with Paradesi Solutions.
                Your Indian IT job application and resume have been
                sent successfully to our Careers team.
            </p>

            <a href="../applicationform.html">
                Back to Application
            </a>

        </div>

    </body>

    </html>
    ';

} catch (Exception $e) {

    error_log(
        'Paradesi Indian IT mail error: ' .
        $mail->ErrorInfo
    );

    http_response_code(500);

    exit(
        'Sorry, your application could not be sent. Please try again later.'
    );
}

?>