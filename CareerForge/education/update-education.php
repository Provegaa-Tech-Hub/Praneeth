<?php

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

if($_SERVER['REQUEST_METHOD'] != 'POST'){

    header("Location: education.php");
    exit();

}

/* ==========================================
GET FORM DATA
========================================== */

$school_name = mysqli_real_escape_string($conn,$_POST['school_name']);
$board = mysqli_real_escape_string($conn,$_POST['board']);
$tenth_year = mysqli_real_escape_string($conn,$_POST['tenth_year']);
$tenth_percentage = mysqli_real_escape_string($conn,$_POST['tenth_percentage']);

$qualification = mysqli_real_escape_string($conn,$_POST['qualification']);
$college_name = mysqli_real_escape_string($conn,$_POST['college_name']);
$course = mysqli_real_escape_string($conn,$_POST['course']);
$inter_year = mysqli_real_escape_string($conn,$_POST['inter_year']);
$inter_percentage = mysqli_real_escape_string($conn,$_POST['inter_percentage']);
$medium = mysqli_real_escape_string($conn,$_POST['medium']);

$degree = mysqli_real_escape_string($conn,$_POST['degree']);
$university = mysqli_real_escape_string($conn,$_POST['university']);
$branch = mysqli_real_escape_string($conn,$_POST['branch']);
$graduation_year = mysqli_real_escape_string($conn,$_POST['graduation_year']);
$graduation_percentage = mysqli_real_escape_string($conn,$_POST['graduation_percentage']);
$graduation_status = mysqli_real_escape_string($conn,$_POST['graduation_status']);

$post_graduation = mysqli_real_escape_string($conn,$_POST['post_graduation']);
$pg_percentage = mysqli_real_escape_string($conn,$_POST['pg_percentage']);
$certifications = mysqli_real_escape_string($conn,$_POST['certifications']);


/* ==========================================
RESUME UPLOAD
========================================== */

$resume = "";

/* Get Existing Resume */

$oldQuery = mysqli_query(

    $conn,

    "SELECT resume
     FROM candidate_education
     WHERE user_id='$userId'
     LIMIT 1"

);

$oldData = mysqli_fetch_assoc($oldQuery);

if($oldData){

    $resume = $oldData['resume'];

}

/* Upload New Resume */

if(isset($_FILES['resume']) && $_FILES['resume']['error']==0){

    $uploadDir = "../uploads/resume/";

    if(!is_dir($uploadDir)){

        mkdir($uploadDir,0777,true);

    }

    $fileName = time()."_".basename($_FILES['resume']['name']);

    $targetFile = $uploadDir.$fileName;

    $extension = strtolower(

        pathinfo(

            $targetFile,

            PATHINFO_EXTENSION

        )

    );

    $allowed = array(

        "pdf",

        "doc",

        "docx"

    );

    if(in_array($extension,$allowed)){

        if(move_uploaded_file(

            $_FILES['resume']['tmp_name'],

            $targetFile

        )){

            $resume = $fileName;

        }

    }

}

/* ==========================================
CHECK EXISTING RECORD
========================================== */

$checkQuery = mysqli_query(

    $conn,

    "SELECT id
     FROM candidate_education
     WHERE user_id='$userId'
     LIMIT 1"

);

if(mysqli_num_rows($checkQuery) > 0){

    /* ==========================================
    UPDATE EDUCATION
    ========================================== */

    mysqli_query(

        $conn,

        "UPDATE candidate_education SET

        school_name='$school_name',
        board='$board',
        tenth_year='$tenth_year',
        tenth_percentage='$tenth_percentage',

        qualification='$qualification',
        college_name='$college_name',
        course='$course',
        inter_year='$inter_year',
        inter_percentage='$inter_percentage',
        medium='$medium',

        degree='$degree',
        university='$university',
        branch='$branch',
        graduation_year='$graduation_year',
        graduation_percentage='$graduation_percentage',
        graduation_status='$graduation_status',

        post_graduation='$post_graduation',
        pg_percentage='$pg_percentage',
        certifications='$certifications',
        resume='$resume'

        WHERE user_id='$userId'"

    );

}else{

    /* ==========================================
    INSERT EDUCATION
    ========================================== */

    mysqli_query(

        $conn,

        "INSERT INTO candidate_education(

        user_id,

        school_name,
        board,
        tenth_year,
        tenth_percentage,

        qualification,
        college_name,
        course,
        inter_year,
        inter_percentage,
        medium,

        degree,
        university,
        branch,
        graduation_year,
        graduation_percentage,
        graduation_status,

        post_graduation,
        pg_percentage,
        certifications,
        resume

        )

        VALUES(

        '$userId',

        '$school_name',
        '$board',
        '$tenth_year',
        '$tenth_percentage',

        '$qualification',
        '$college_name',
        '$course',
        '$inter_year',
        '$inter_percentage',
        '$medium',

        '$degree',
        '$university',
        '$branch',
        '$graduation_year',
        '$graduation_percentage',
        '$graduation_status',

        '$post_graduation',
        '$pg_percentage',
        '$certifications',
        '$resume'

        )"

    );

}

/* ==========================================
CHECK DATABASE ERROR
========================================== */

if(mysqli_error($conn)){

    die("Database Error : ".mysqli_error($conn));

}

/* ==========================================
SUCCESS MESSAGE
========================================== */

$_SESSION['education_success'] = "Education details updated successfully!";

/* ==========================================
REDIRECT
========================================== */

header("Location: education.php");

exit();

?>