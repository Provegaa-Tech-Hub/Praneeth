<?php

session_start();

require_once("../database/db.php");

/* ==========================================
CHECK LOGIN
========================================== */

if (!isset($_SESSION['user_id'])) {
    exit("Login Required");
}

$userId = (int)$_SESSION['user_id'];

/* ==========================================
CHECK FILE
========================================== */

if (!isset($_FILES['photo']) || $_FILES['photo']['error'] != 0) {
    exit("No File");
}

/* ==========================================
GET CURRENT PHOTO
========================================== */

$query = mysqli_query(
    $conn,
    "SELECT profile_photo
     FROM users
     WHERE id='$userId'"
);

if (!$query) {
    exit("Database Error : " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($query);

$currentPhoto = $user['profile_photo'] ?? "default.png";

/* ==========================================
UPLOAD DIRECTORY
========================================== */

$uploadDir = "../assets/images/profile/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

/* ==========================================
VALIDATE IMAGE
========================================== */

$allowed = ["jpg", "jpeg", "png", "gif", "webp"];

$extension = strtolower(
    pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION)
);

if (!in_array($extension, $allowed)) {
    exit("Invalid File");
}

/* ==========================================
CHECK SIZE
========================================== */

if ($_FILES['photo']['size'] > 2 * 1024 * 1024) {
    exit("Image Too Large");
}

/* ==========================================
CREATE FILE NAME
========================================== */

$newFile = "profile_" . $userId . "_" . time() . "." . $extension;

/* ==========================================
MOVE IMAGE
========================================== */

if (!move_uploaded_file(
    $_FILES['photo']['tmp_name'],
    $uploadDir . $newFile
)) {
    exit("Upload Failed");
}

/* ==========================================
DELETE OLD PHOTO
========================================== */

if (
    !empty($currentPhoto) &&
    $currentPhoto != "default.png" &&
    file_exists($uploadDir . $currentPhoto)
) {
    unlink($uploadDir . $currentPhoto);
}

/* ==========================================
UPDATE DATABASE
========================================== */

$update = mysqli_query(
    $conn,
    "UPDATE users
     SET profile_photo='$newFile'
     WHERE id='$userId'"
);

if (!$update) {
    exit("Database Error : " . mysqli_error($conn));
}

/* ==========================================
RETURN FILE NAME
========================================== */

echo $newFile;
exit();

?>

