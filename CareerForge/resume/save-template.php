<?php

session_start();

require_once("../database/db.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: ../login.php");
    exit();

}

$userId = $_SESSION['user_id'];

/* ==========================================
CHECK TEMPLATE
========================================== */

if (!isset($_GET['template'])) {

    header("Location: templates.php");
    exit();

}

$template = (int)$_GET['template'];

/* ==========================================
VALIDATE TEMPLATE
========================================== */

if (!in_array($template, [1,2,3])) {

    header("Location: templates.php");
    exit();

}


/* ==========================================
SAVE TEMPLATE
========================================== */

$update = mysqli_query(

    $conn,

    "UPDATE users
     SET resume_template='$template'
     WHERE id='$userId'"

);

if(!$update){

    die(mysqli_error($conn));

}

/* ==========================================
SUCCESS MESSAGE
========================================== */

$_SESSION['success'] = "Resume template selected successfully.";

/* ==========================================
REDIRECT
========================================== */

header("Location: templates.php");

exit();

?>