<?php

session_start();

require_once("../database/db.php");

if(!isset($_SESSION['user_id'])){

    header("Location: ../login.php");
    exit();

}

$userId=$_SESSION['user_id'];

/* ==========================================
GET CURRENT RESUME
========================================== */

$userQuery=mysqli_query(

$conn,

"SELECT resume
FROM users
WHERE id='$userId'"

);

if(mysqli_num_rows($userQuery)==0){

    $_SESSION['error']="Candidate not found.";

    header("Location: upload-resume.php");
    exit();

}

$user=mysqli_fetch_assoc($userQuery);

$resume=$user['resume'];

/* ==========================================
DELETE FILE
========================================== */

if(

!empty($resume)

&&

file_exists("uploads/".$resume)

){

    unlink("uploads/".$resume);

}

/* ==========================================
UPDATE DATABASE
========================================== */

$update=mysqli_query(

$conn,

"UPDATE users

SET resume=NULL

WHERE id='$userId'"

);

if(!$update){

    $_SESSION['error']="Unable to delete resume.";

    header("Location: upload-resume.php");
    exit();

}

/* ==========================================
SUCCESS
========================================== */

$_SESSION['success']="Resume deleted successfully.";

header("Location: upload-resume.php");

exit();

?>