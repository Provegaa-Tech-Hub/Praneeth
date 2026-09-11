<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');

/* =========================================================
   ABROAD JOB APPLICATION
   PARADESI SOLUTIONS
   ========================================================= */

/* =========================================================
   OFFICE EMAIL
   ========================================================= */

$officeEmail = "abroadsupport@paradesisolutions.com";

/* =========================================================
   PHPMailer
   ========================================================= */

require_once __DIR__ . '/../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';
require_once __DIR__ . '/mail-config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


/* =========================================================
   ONLY ALLOW POST REQUEST
   ========================================================= */

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../application.html");
    exit;
}


/* =========================================================
   GET FORM DATA
   ========================================================= */

$full_name = trim($_POST["full_name"] ?? "");
$mobile = trim($_POST["mobile"] ?? "");
$email = trim($_POST["email"] ?? "");
$date_of_birth = trim($_POST["date_of_birth"] ?? "");
$gender = trim($_POST["gender"] ?? "");
$nationality = trim($_POST["nationality"] ?? "");
$current_city = trim($_POST["current_city"] ?? "");

$passport_number = trim($_POST["passport_number"] ?? "");

$passport_from_day = trim($_POST["passport_from_day"] ?? "");
$passport_from_month = trim($_POST["passport_from_month"] ?? "");
$passport_from_year = trim($_POST["passport_from_year"] ?? "");

$passport_to_day = trim($_POST["passport_to_day"] ?? "");
$passport_to_month = trim($_POST["passport_to_month"] ?? "");
$passport_to_year = trim($_POST["passport_to_year"] ?? "");

$preferred_country = trim($_POST["preferred_country"] ?? "");
$preferred_job_role = trim($_POST["preferred_job_role"] ?? "");
$preferred_location = trim($_POST["preferred_location"] ?? "");
$years_experience = trim($_POST["years_experience"] ?? "");
$notice_period = trim($_POST["notice_period"] ?? "");
$technical_skills = trim($_POST["technical_skills"] ?? "");
$additional_information = trim($_POST["additional_information"] ?? "");


/* =========================================================
   REQUIRED FIELD VALIDATION
   ========================================================= */

if (
    $full_name === "" ||
    $mobile === "" ||
    $email === "" ||
    $date_of_birth === "" ||
    $passport_number === "" ||
    $preferred_country === ""
) {
    showMessage(
        "Application Incomplete",
        "Please fill all required fields before submitting.",
        false
    );
}


/* =========================================================
   EMAIL VALIDATION
   ========================================================= */

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    showMessage(
        "Invalid Email",
        "Please enter a valid email address.",
        false
    );
}


/* =========================================================
   RESUME VALIDATION
   ========================================================= */

if (
    !isset($_FILES["resume"]) ||
    $_FILES["resume"]["error"] !== UPLOAD_ERR_OK
) {
    showMessage(
        "Resume Required",
        "Please upload your CV/Resume before submitting.",
        false
    );
}

$resume = $_FILES["resume"];


/* =========================================================
   FILE SIZE LIMIT - 10 MB
   ========================================================= */

$maxFileSize = 10 * 1024 * 1024;

if ($resume["size"] > $maxFileSize) {
    showMessage(
        "File Too Large",
        "Please upload a resume smaller than 10 MB.",
        false
    );
}


/* =========================================================
   ALLOWED RESUME EXTENSIONS
   ========================================================= */

$allowedExtensions = array(
    "pdf",
    "doc",
    "docx"
);

$originalFileName = basename($resume["name"]);

$fileExtension = strtolower(
    pathinfo($originalFileName, PATHINFO_EXTENSION)
);

if (!in_array($fileExtension, $allowedExtensions, true)) {
    showMessage(
        "Invalid Resume",
        "Only PDF, DOC and DOCX files are allowed.",
        false
    );
}


/* =========================================================
   SANITIZE VALUES FOR EMAIL
   ========================================================= */

function cleanForEmail($value)
{
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        "UTF-8"
    );
}


/* =========================================================
   CLEAN DATA
   ========================================================= */

$full_name_email = cleanForEmail($full_name);
$mobile_email = cleanForEmail($mobile);
$email_email = cleanForEmail($email);
$date_of_birth_email = cleanForEmail($date_of_birth);
$gender_email = cleanForEmail($gender);
$nationality_email = cleanForEmail($nationality);
$current_city_email = cleanForEmail($current_city);
$passport_number_email = cleanForEmail($passport_number);

$passport_from_email = cleanForEmail(
    $passport_from_day . "/" .
    $passport_from_month . "/" .
    $passport_from_year
);

$passport_to_email = cleanForEmail(
    $passport_to_day . "/" .
    $passport_to_month . "/" .
    $passport_to_year
);

$preferred_country_email = cleanForEmail($preferred_country);
$preferred_job_role_email = cleanForEmail($preferred_job_role);
$preferred_location_email = cleanForEmail($preferred_location);
$years_experience_email = cleanForEmail($years_experience);
$notice_period_email = cleanForEmail($notice_period);

$technical_skills_email =
    nl2br(cleanForEmail($technical_skills));

$additional_information_email =
    nl2br(cleanForEmail($additional_information));

$file_name_email =
    cleanForEmail($originalFileName);


/* =========================================================
   EMAIL SUBJECT
   ========================================================= */

$subject =
    "New Abroad Job Application - " .
    $full_name;


/* =========================================================
   EMAIL BODY
   ========================================================= */

$message = "

<html>

<head>

<style>

body {
    font-family: Arial, Helvetica, sans-serif;
    background: #f5f5f5;
    color: #222;
}

.email-container {
    max-width: 750px;
    margin: auto;
    background: #ffffff;
    border: 1px solid #dddddd;
}

.email-header {
    background: #073f73;
    color: #ffffff;
    padding: 20px;
    text-align: center;
}

.email-header h2 {
    margin: 0;
}

.email-body {
    padding: 25px;
}

.info-table {
    width: 100%;
    border-collapse: collapse;
}

.info-table td {
    padding: 10px;
    border-bottom: 1px solid #eeeeee;
    vertical-align: top;
}

.info-table td:first-child {
    width: 35%;
    font-weight: bold;
}

.section-title {
    background: #f0f5f9;
    padding: 10px;
    margin-top: 20px;
    margin-bottom: 10px;
    font-weight: bold;
    color: #073f73;
}

</style>

</head>

<body>

<div class='email-container'>

    <div class='email-header'>

        <h2>New Abroad Job Application</h2>

        <p>Paradesi Solutions</p>

    </div>

    <div class='email-body'>

        <div class='section-title'>
            Personal Information
        </div>

        <table class='info-table'>

            <tr>
                <td>Full Name</td>
                <td>$full_name_email</td>
            </tr>

            <tr>
                <td>Mobile Number</td>
                <td>$mobile_email</td>
            </tr>

            <tr>
                <td>Email Address</td>
                <td>$email_email</td>
            </tr>

            <tr>
                <td>Date of Birth</td>
                <td>$date_of_birth_email</td>
            </tr>

            <tr>
                <td>Gender</td>
                <td>$gender_email</td>
            </tr>

            <tr>
                <td>Nationality</td>
                <td>$nationality_email</td>
            </tr>

            <tr>
                <td>Current City</td>
                <td>$current_city_email</td>
            </tr>

        </table>


        <div class='section-title'>
            Passport Information
        </div>

        <table class='info-table'>

            <tr>
                <td>Passport Number</td>
                <td>$passport_number_email</td>
            </tr>

            <tr>
                <td>Passport Valid From</td>
                <td>$passport_from_email</td>
            </tr>

            <tr>
                <td>Passport Valid To</td>
                <td>$passport_to_email</td>
            </tr>

        </table>


        <div class='section-title'>
            Job Preferences
        </div>

        <table class='info-table'>

            <tr>
                <td>Preferred Country</td>
                <td>$preferred_country_email</td>
            </tr>

            <tr>
                <td>Preferred Job Role</td>
                <td>$preferred_job_role_email</td>
            </tr>

            <tr>
                <td>Preferred Location</td>
                <td>$preferred_location_email</td>
            </tr>

            <tr>
                <td>Years of Experience</td>
                <td>$years_experience_email</td>
            </tr>

            <tr>
                <td>Notice Period</td>
                <td>$notice_period_email</td>
            </tr>

        </table>


        <div class='section-title'>
            Skills
        </div>

        <table class='info-table'>

            <tr>
                <td>Technical Skills</td>
                <td>$technical_skills_email</td>
            </tr>

        </table>


        <div class='section-title'>
            Additional Information
        </div>

        <table class='info-table'>

            <tr>
                <td>Additional Information</td>
                <td>$additional_information_email</td>
            </tr>

        </table>


        <div class='section-title'>
            Resume
        </div>

        <table class='info-table'>

            <tr>
                <td>Uploaded File</td>
                <td>$file_name_email</td>
            </tr>

        </table>

    </div>

</div>

</body>

</html>
";


/* =========================================================
   CREATE PHPMailer
   ========================================================= */

$mail = new PHPMailer(true);

try {

    /* =====================================================
       SMTP SETTINGS
       ===================================================== */

    $mail->isSMTP();

    $mail->Host = $SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = $SMTP_USERNAME;
    $mail->Password = $SMTP_PASSWORD;
    $mail->SMTPSecure = $SMTP_SECURE;
    $mail->Port = $SMTP_PORT;
    $mail->CharSet = "UTF-8";


    /* =====================================================
       EMAIL SETTINGS
       ===================================================== */

    $mail->isHTML(true);

    /*
     * Sender must be your authenticated mailbox.
     */

    $mail->setFrom(
        $SMTP_FROM_EMAIL,
        "Paradesi Solutions"
    );


    /* =====================================================
       ABROAD SUPPORT EMAIL
       ===================================================== */

    $mail->addAddress(
        "abroadsupport@paradesisolutions.com"
    );


    /* =====================================================
       REPLY TO APPLICANT
       ===================================================== */

    $mail->addReplyTo(
        $email,
        $full_name
    );


    /* =====================================================
       SUBJECT
       ===================================================== */

    $mail->Subject = $subject;


    /* =====================================================
       MESSAGE
       ===================================================== */

    $mail->Body = $message;


    /* =====================================================
       PLAIN TEXT VERSION
       ===================================================== */

    $mail->AltBody =
        "New Abroad Job Application\n\n" .
        "Full Name: " . $full_name . "\n" .
        "Mobile: " . $mobile . "\n" .
        "Email: " . $email . "\n" .
        "Date of Birth: " . $date_of_birth . "\n" .
        "Gender: " . $gender . "\n" .
        "Nationality: " . $nationality . "\n" .
        "Current City: " . $current_city . "\n\n" .

        "Passport Number: " . $passport_number . "\n" .
        "Passport Valid From: " .
        $passport_from_day . "/" .
        $passport_from_month . "/" .
        $passport_from_year . "\n" .

        "Passport Valid To: " .
        $passport_to_day . "/" .
        $passport_to_month . "/" .
        $passport_to_year . "\n\n" .

        "Preferred Country: " .
        $preferred_country . "\n" .

        "Preferred Job Role: " .
        $preferred_job_role . "\n" .

        "Preferred Location: " .
        $preferred_location . "\n" .

        "Years of Experience: " .
        $years_experience . "\n" .

        "Notice Period: " .
        $notice_period . "\n\n" .

        "Technical Skills:\n" .
        $technical_skills . "\n\n" .

        "Additional Information:\n" .
        $additional_information;


/* =====================================================
   ATTACH RESUME
   ===================================================== */

    $mail->addAttachment(
        $resume["tmp_name"],
        $originalFileName
    );


/* =====================================================
   SEND EMAIL
   ===================================================== */

    $mail->send();


    showMessage(
        "Application Submitted Successfully!",
        "Thank you for applying with Paradesi Solutions. Your application and resume have been sent successfully to our Abroad Job Support team.",
        true
    );


} catch (Exception $e) {

    error_log(
        "Paradesi Abroad Job mail error: " .
        $mail->ErrorInfo
    );

    showMessage(
        "Application Could Not Be Sent",
        "There was a problem while sending your application. Please try again later.",
        false
    );
}


/* =========================================================
   SUCCESS / ERROR MESSAGE
   ========================================================= */

function showMessage(
    $title,
    $message,
    $success = true
) {

    $title = htmlspecialchars(
        $title,
        ENT_QUOTES,
        "UTF-8"
    );

    $message = htmlspecialchars(
        $message,
        ENT_QUOTES,
        "UTF-8"
    );

    $color = $success
        ? "#008000"
        : "#c62828";

    $buttonColor = $success
        ? "#0077a8"
        : "#555555";


    echo "

    <!DOCTYPE html>

    <html lang='en'>

    <head>

        <meta charset='UTF-8'>

        <meta
            name='viewport'
            content='width=device-width, initial-scale=1.0'
        >

        <title>$title</title>

        <style>

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                font-family: Arial, Helvetica, sans-serif;
            }

            body {

                min-height: 100vh;

                display: flex;

                justify-content: center;

                align-items: center;

                padding: 20px;

                background:
                    linear-gradient(
                        rgba(10,20,35,.65),
                        rgba(10,20,35,.65)
                    ),
                    url('../images/job support.jpg');

                background-size: cover;

                background-position: center;

            }

            .message-box {

                width: 100%;

                max-width: 600px;

                background: #ffffff;

                padding: 45px 35px;

                border-radius: 15px;

                text-align: center;

                box-shadow:
                    0 15px 40px
                    rgba(0,0,0,.30);

            }

            .icon {

                font-size: 55px;

                color: $color;

                margin-bottom: 15px;

            }

            h1 {

                color: $color;

                margin-bottom: 15px;

                font-size: 28px;

            }

            p {

                color: #555;

                font-size: 16px;

                line-height: 1.7;

                margin-bottom: 25px;

            }

            a {

                display: inline-block;

                text-decoration: none;

                background: $buttonColor;

                color: #ffffff;

                padding: 13px 28px;

                border-radius: 7px;

                font-weight: bold;

            }

            a:hover {

                opacity: .85;

            }

        </style>

    </head>


    <body>

        <div class='message-box'>

            <div class='icon'>
                " . ($success ? "✔" : "✖") . "
            </div>

            <h1>
                $title
            </h1>

            <p>
                $message
            </p>

            <a href='../application.html'>
                Back To Application
            </a>

        </div>

    </body>

    </html>

    ";

    exit;
}

?>