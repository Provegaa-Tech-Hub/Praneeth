<?php
session_start();
require_once("../database/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: job-preference.php");
    exit();
}

/* ==========================================
GET FORM DATA
========================================== */

$career_choice       = mysqli_real_escape_string($conn, $_POST['career_choice'] ?? "");

$job_role            = mysqli_real_escape_string($conn, $_POST['job_role'] ?? "");
$preferred_industry  = mysqli_real_escape_string($conn, $_POST['preferred_industry'] ?? "");
$employment_type     = mysqli_real_escape_string($conn, $_POST['employment_type'] ?? "");
$work_mode           = mysqli_real_escape_string($conn, $_POST['work_mode'] ?? "");

$experience_type     = mysqli_real_escape_string($conn, $_POST['experience_type'] ?? "");

$total_experience    = mysqli_real_escape_string($conn, $_POST['total_experience'] ?? "");
$relevant_experience = mysqli_real_escape_string($conn, $_POST['relevant_experience'] ?? "");
$current_ctc         = mysqli_real_escape_string($conn, $_POST['current_ctc'] ?? "");
$expected_ctc        = mysqli_real_escape_string($conn, $_POST['expected_ctc'] ?? "");

$preferred_location  = mysqli_real_escape_string($conn, $_POST['preferred_location'] ?? "");
$preferred_location2 = mysqli_real_escape_string($conn, $_POST['preferred_location2'] ?? "");
$preferred_location3 = mysqli_real_escape_string($conn, $_POST['preferred_location3'] ?? "");

$relocate            = mysqli_real_escape_string($conn, $_POST['relocate'] ?? "");
$notice_period       = mysqli_real_escape_string($conn, $_POST['notice_period'] ?? "");
$joining_date        = mysqli_real_escape_string($conn, $_POST['joining_date'] ?? "");

$primary_skills      = mysqli_real_escape_string($conn, $_POST['primary_skills'] ?? "");
$secondary_skills    = mysqli_real_escape_string($conn, $_POST['secondary_skills'] ?? "");

/* ==========================================
CLEAR EXPERIENCE IF FRESHER
========================================== */

if($experience_type=="Fresher"){

    $total_experience="";
    $relevant_experience="";
    $current_ctc="";
    $notice_period="";
    $joining_date="0000-00-00";

}

/* ==========================================
RESUME UPLOAD
========================================== */

$resume="";

$getResume=mysqli_query(
    $conn,
    "SELECT resume FROM users WHERE id='$userId'"
);

$data=mysqli_fetch_assoc($getResume);

$resume=$data['resume'] ?? "";

if(isset($_FILES['resume']) && $_FILES['resume']['error']==0){

    $uploadDir="../assets/uploads/resume/";

    if(!is_dir($uploadDir)){
        mkdir($uploadDir,0777,true);
    }

    $extension=strtolower(
        pathinfo($_FILES['resume']['name'],PATHINFO_EXTENSION)
    );

    $allowed=["pdf","doc","docx"];

    if(in_array($extension,$allowed)){

        $resume=time()."_".basename($_FILES['resume']['name']);

        move_uploaded_file(
            $_FILES['resume']['tmp_name'],
            $uploadDir.$resume
        );

    }

}

/* ==========================================
UPDATE USERS TABLE
========================================== */

$sql="UPDATE users SET

career_choice='$career_choice',

job_role='$job_role',

preferred_industry='$preferred_industry',

employment_type='$employment_type',

work_mode='$work_mode',

professional_type='$experience_type',

total_experience='$total_experience',

relevant_experience='$relevant_experience',

current_ctc='$current_ctc',

expected_ctc='$expected_ctc',

preferred_location='$preferred_location',

preferred_location2='$preferred_location2',

preferred_location3='$preferred_location3',

relocate='$relocate',

notice_period='$notice_period',

joining_date='$joining_date',

primary_skills='$primary_skills',

secondary_skills='$secondary_skills',

resume='$resume'

WHERE id='$userId'";

$result=mysqli_query($conn,$sql);

/* ==========================================
SUCCESS / ERROR
========================================== */

if($result){

    $_SESSION['success_message']="Job Preference Updated Successfully.";

}else{

    $_SESSION['error_message']="Database Error : ".mysqli_error($conn);

}

/* ==========================================
REDIRECT
========================================== */

header("Location: job-preference.php");
exit();

?>