<?php

session_start();

require_once("../database/db.php");

if(!isset($_SESSION['user_id'])){

    header("Location: ../login.php");
    exit();

}

$userId=$_SESSION['user_id'];

/* ==========================================
CHECK REQUEST
========================================== */

if($_SERVER["REQUEST_METHOD"]!="POST"){

    header("Location: upload-resume.php");
    exit();

}

/* ==========================================
CHECK FILE
========================================== */

if(!isset($_FILES['resume'])){

    $_SESSION['error']="Please select a resume.";

    header("Location: upload-resume.php");
    exit();

}

$file=$_FILES['resume'];

if($file['error']!=0){

    $_SESSION['error']="File upload failed.";

    header("Location: upload-resume.php");
    exit();

}

/* ==========================================
VALID FILE TYPE
========================================== */

$allowed=[

    "pdf",

    "doc",

    "docx"

];

$extension=strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));

if(!in_array($extension,$allowed)){

    $_SESSION['error']="Only PDF, DOC and DOCX files are allowed.";

    header("Location: upload-resume.php");
    exit();

}

/* ==========================================
FILE SIZE
========================================== */

if($file['size']>5*1024*1024){

    $_SESSION['error']="Maximum file size is 5 MB.";

    header("Location: upload-resume.php");
    exit();

}


/* ==========================================
UPLOAD DIRECTORY
========================================== */
$uploadDir = "../assets/uploads/resume/";

if(!is_dir($uploadDir)){

    mkdir($uploadDir,0777,true);

}

/* ==========================================
GET OLD RESUME
========================================== */

$userQuery=mysqli_query(

$conn,

"SELECT resume
FROM users
WHERE id='$userId'"

);

$user=mysqli_fetch_assoc($userQuery);

$oldResume=$user['resume'];

/* ==========================================
GENERATE NEW FILE NAME
========================================== */

$newFileName=

"user_".

$userId.

"_".

time().

".".

$extension;

$destination=$uploadDir.$newFileName;

/* ==========================================
MOVE FILE
========================================== */

if(!move_uploaded_file($file['tmp_name'],$destination)){

    $_SESSION['error']="Unable to upload resume.";

    header("Location: upload-resume.php");

    exit();

}

/* ==========================================
DELETE OLD RESUME
========================================== */

if(

!empty($oldResume)

&&

file_exists($uploadDir.$oldResume)

){

    unlink($uploadDir.$oldResume);

}

/* ==========================================
UPDATE DATABASE
========================================== */

$update=mysqli_query(

$conn,

"UPDATE users

SET resume='$newFileName'

WHERE id='$userId'"

);

if(!$update){

    $_SESSION['error']="Database update failed.";

    header("Location: upload-resume.php");

    exit();

}

/* ==========================================
SUCCESS
========================================== */

$_SESSION['success']="Resume uploaded successfully.";

header("Location: upload-resume.php");

exit();

?>