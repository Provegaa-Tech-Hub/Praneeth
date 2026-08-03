<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once("../database/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];

/* ==========================================
CHECK REQUEST
========================================== */

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: available-jobs.php");
    exit();
}

/* ==========================================
GET FORM DATA
========================================== */

$jobId = (int)($_POST['job_id'] ?? 0);

$coverLetter = mysqli_real_escape_string(
    $conn,
    trim($_POST['cover_letter'] ?? "")
);

$expectedCTC = mysqli_real_escape_string(
    $conn,
    trim($_POST['expected_ctc'] ?? "")
);

$joiningTime = mysqli_real_escape_string(
    $conn,
    trim($_POST['joining_time'] ?? "")
);

$relocate = mysqli_real_escape_string(
    $conn,
    trim($_POST['relocate'] ?? "")
);

/* ==========================================
CHECK DUPLICATE APPLICATION
========================================== */

$check = mysqli_query(
    $conn,
    "SELECT id FROM applications
     WHERE user_id='$userId'
     AND job_id='$jobId'"
);

if (mysqli_num_rows($check) > 0) {

    $_SESSION['error_message'] = "You have already applied for this job.";

    header("Location: applications.php");

    exit();
}

/* ==========================================
GET EXISTING RESUME
========================================== */

$resume = "";

$userQuery = mysqli_query(
    $conn,
    "SELECT resume FROM users WHERE id='$userId'"
);

if ($userQuery && mysqli_num_rows($userQuery) > 0) {

    $user = mysqli_fetch_assoc($userQuery);

    $resume = $user['resume'];

}

/* ==========================================
UPLOAD NEW RESUME
========================================== */

if (
    isset($_FILES["resume"]) &&
    $_FILES["resume"]["error"] == 0
) {

    $uploadDir = "../assets/uploads/resume/";

    if (!is_dir($uploadDir)) {

        mkdir($uploadDir, 0777, true);

    }

    $extension = strtolower(
        pathinfo(
            $_FILES["resume"]["name"],
            PATHINFO_EXTENSION
        )
    );

    $allowed = array("pdf", "doc", "docx");

    if (!in_array($extension, $allowed)) {

        die("Only PDF, DOC and DOCX files are allowed.");

    }

    if ($_FILES["resume"]["size"] > 5 * 1024 * 1024) {

        die("Resume size must be less than 5MB.");

    }

    $resume = time() . "_" . basename($_FILES["resume"]["name"]);

    if (
        !move_uploaded_file(
            $_FILES["resume"]["tmp_name"],
            $uploadDir . $resume
        )
    ) {

        die("Resume upload failed.");

    }

}

/* ==========================================
INSERT APPLICATION
========================================== */

$sql = "INSERT INTO applications (

user_id,
job_id,
cover_letter,
expected_ctc,
joining_time,
relocate,
resume,
application_status,
applied_date

)

VALUES (

'$userId',
'$jobId',
'$coverLetter',
'$expectedCTC',
'$joiningTime',
'$relocate',
'$resume',
'Applied',
NOW()

)";

$result = mysqli_query($conn, $sql);

/* ==========================================
SHOW MYSQL ERROR
========================================== */

if (!$result) {

    die("<h2>Database Error</h2><br>" . mysqli_error($conn));

}

/* ==========================================
UPDATE USER COUNT
========================================== */

mysqli_query(

    $conn,

    "UPDATE users
     SET applied_jobs = applied_jobs + 1
     WHERE id='$userId'"

);

/* ==========================================
SUCCESS
========================================== */

$_SESSION['success_message'] =
"Application Submitted Successfully.";

header("Location: applications.php");

exit();
?>