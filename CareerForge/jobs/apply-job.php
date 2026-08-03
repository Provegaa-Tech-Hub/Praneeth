<?php
session_start();

require_once("../database/db.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: ../login.php");

    exit();

}

$userId = $_SESSION['user_id'];

if (!isset($_GET['id'])) {

    header("Location: available-jobs.php");

    exit();

}

$jobId = (int)$_GET['id'];

/* ===========================
CHECK JOB EXISTS
=========================== */

$jobQuery = mysqli_query(
    $conn,
    "SELECT * FROM jobs WHERE id='$jobId' AND status='Open'"
);

if (mysqli_num_rows($jobQuery) == 0) {

    die("Job not found.");

}

$job = mysqli_fetch_assoc($jobQuery);

/* ===========================
CHECK ALREADY APPLIED
=========================== */

$check = mysqli_query(

$conn,

"SELECT id
FROM applications
WHERE user_id='$userId'
AND job_id='$jobId'"

);

if(mysqli_num_rows($check)>0){

$_SESSION['error_message']="You have already applied for this job.";

header("Location: available-jobs.php");

exit();

}

/* ==========================================
SAVE APPLICATION
========================================== */

$insert = mysqli_query(

$conn,

"INSERT INTO applications(

user_id,

job_id,

application_status

)

VALUES(

'$userId',

'$jobId',

'Applied'

)"

);

/* ==========================================
UPDATE APPLIED JOB COUNT
========================================== */

if($insert){

mysqli_query(

$conn,

"UPDATE users

SET applied_jobs = applied_jobs + 1

WHERE id='$userId'"

);

$_SESSION['success_message']="Application submitted successfully.";

header("Location: applications.php");

exit();

}

/* ==========================================
ERROR
========================================== */

$_SESSION['error_message']="Unable to submit application. Please try again.";

header("Location: available-jobs.php");

exit();

?>