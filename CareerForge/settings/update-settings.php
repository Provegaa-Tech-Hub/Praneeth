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

    header("Location: settings.php");
    exit();

}

/* ==========================================
GET FORM DATA
========================================== */

$full_name=mysqli_real_escape_string($conn,trim($_POST['full_name']));

$email=mysqli_real_escape_string($conn,trim($_POST['email']));

$mobile=mysqli_real_escape_string($conn,trim($_POST['mobile']));

/* ==========================================
VALIDATION
========================================== */

if(empty($full_name) || empty($email) || empty($mobile)){

    $_SESSION['error']="All fields are required.";

    header("Location: settings.php");

    exit();

}

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

    $_SESSION['error']="Invalid email address.";

    header("Location: settings.php");

    exit();

}

if(!preg_match('/^[0-9]{10}$/',$mobile)){

    $_SESSION['error']="Mobile number must contain exactly 10 digits.";

    header("Location: settings.php");

    exit();

}

/* ==========================================
GET CURRENT PROFILE PHOTO
========================================== */

$userQuery=mysqli_query(

$conn,

"SELECT profile_photo
FROM users
WHERE id='$userId'"

);

$user=mysqli_fetch_assoc($userQuery);

$profilePhoto=$user['profile_photo'];
/* ==========================================
UPLOAD NEW PROFILE PHOTO
========================================== */

if(

isset($_FILES['profile_photo'])

&&

$_FILES['profile_photo']['error']==0

){

    $allowed=[

        "jpg",

        "jpeg",

        "png",

        "gif",

        "webp"

    ];

    $extension=strtolower(

        pathinfo(

            $_FILES['profile_photo']['name'],

            PATHINFO_EXTENSION

        )

    );

    if(in_array($extension,$allowed)){

        $uploadDir="../assets/images/profile/";

        if(!is_dir($uploadDir)){

            mkdir($uploadDir,0777,true);

        }

        $newPhoto=

        "profile_".$userId."_".time().".".$extension;

        if(

            move_uploaded_file(

                $_FILES['profile_photo']['tmp_name'],

                $uploadDir.$newPhoto

            )

        ){

            if(

                !empty($profilePhoto)

                &&

                $profilePhoto!="default.png"

                &&

                file_exists($uploadDir.$profilePhoto)

            ){

                unlink($uploadDir.$profilePhoto);

            }

            $profilePhoto=$newPhoto;

        }

    }

}

/* ==========================================
UPDATE PROFILE
========================================== */

$update=mysqli_query(

$conn,

"UPDATE users SET

full_name='$full_name',

email='$email',

mobile='$mobile',

profile_photo='$profilePhoto'

WHERE id='$userId'"

);

if(!$update){

    $_SESSION['error']="Unable to update profile.";

    header("Location: settings.php");

    exit();

}

/* ==========================================
CHANGE PASSWORD
========================================== */

if(

!empty($_POST['current_password'])

&&

!empty($_POST['new_password'])

){

    $currentPassword=$_POST['current_password'];

    $newPassword=$_POST['new_password'];

    $passwordQuery=mysqli_query(

        $conn,

        "SELECT password

        FROM users

        WHERE id='$userId'"

    );

    $passwordData=mysqli_fetch_assoc($passwordQuery);

    if(

        password_verify(

            $currentPassword,

            $passwordData['password']

        )

    ){

        $hashedPassword=password_hash(

            $newPassword,

            PASSWORD_DEFAULT

        );

        mysqli_query(

            $conn,

            "UPDATE users

            SET password='$hashedPassword'

            WHERE id='$userId'"

        );

    }else{

        $_SESSION['error']="Current password is incorrect.";

        header("Location: settings.php");

        exit();

    }

}

/* ==========================================
SUCCESS
========================================== */

$_SESSION['success']="Settings updated successfully.";

header("Location: settings.php");

exit();

?>