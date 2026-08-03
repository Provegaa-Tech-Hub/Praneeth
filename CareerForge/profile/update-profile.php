<?php

session_start();

require_once("../database/db.php");


// ======================================
// CHECK LOGIN
// ======================================

if(!isset($_SESSION['user_id'])){

    header("Location: ../login.php");
    exit();

}


$userId = $_SESSION['user_id'];



// ======================================
// CHECK REQUEST
// ======================================

if($_SERVER["REQUEST_METHOD"] != "POST"){

    header("Location: profile.php");
    exit();

}



// ======================================
// GET FORM DATA
// ======================================


$full_name = mysqli_real_escape_string(
    $conn,
    $_POST['full_name'] ?? ''
);


$email = mysqli_real_escape_string(
    $conn,
    $_POST['email'] ?? ''
);


$mobile = mysqli_real_escape_string(
    $conn,
    $_POST['mobile'] ?? ''
);


$dob = mysqli_real_escape_string(
    $conn,
    $_POST['dob'] ?? ''
);


$gender = mysqli_real_escape_string(
    $conn,
    $_POST['gender'] ?? ''
);


$blood_group = mysqli_real_escape_string(
    $conn,
    $_POST['blood_group'] ?? ''
);


$marital_status = mysqli_real_escape_string(
    $conn,
    $_POST['marital_status'] ?? ''
);


$nationality = mysqli_real_escape_string(
    $conn,
    $_POST['nationality'] ?? ''
);



// CONTACT

$father_name = mysqli_real_escape_string(
    $conn,
    $_POST['father_name'] ?? ''
);


$mother_name = mysqli_real_escape_string(
    $conn,
    $_POST['mother_name'] ?? ''
);


$emergency_contact = mysqli_real_escape_string(
    $conn,
    $_POST['emergency_contact'] ?? ''
);


$alternate_mobile = mysqli_real_escape_string(
    $conn,
    $_POST['alternate_mobile'] ?? ''
);



// ADDRESS


$address = mysqli_real_escape_string(
    $conn,
    $_POST['address'] ?? ''
);


$city = mysqli_real_escape_string(
    $conn,
    $_POST['city'] ?? ''
);


$state = mysqli_real_escape_string(
    $conn,
    $_POST['state'] ?? ''
);


$pincode = mysqli_real_escape_string(
    $conn,
    $_POST['pincode'] ?? ''
);


$country = mysqli_real_escape_string(
    $conn,
    $_POST['country'] ?? 'India'
);

// ======================================
// SOCIAL PROFILES
// ======================================

$linkedin = mysqli_real_escape_string(
    $conn,
    $_POST['linkedin'] ?? ''
);

$github = mysqli_real_escape_string(
    $conn,
    $_POST['github'] ?? ''
);

$instagram = mysqli_real_escape_string(
    $conn,
    $_POST['instagram'] ?? ''
);

$portfolio = mysqli_real_escape_string(
    $conn,
    $_POST['portfolio'] ?? ''
);



// IDENTITY


$aadhaar = mysqli_real_escape_string(
    $conn,
    $_POST['aadhaar'] ?? ''
);


$pan = mysqli_real_escape_string(
    $conn,
    $_POST['pan'] ?? ''
);

// ======================================
// UPDATE DATABASE
// ======================================

$query = mysqli_query(
    $conn,

    "UPDATE users SET

    full_name='$full_name',
    email='$email',
    mobile='$mobile',
    dob='$dob',
    gender='$gender',
    blood_group='$blood_group',
    marital_status='$marital_status',
    nationality='$nationality',

    father_name='$father_name',
    mother_name='$mother_name',
    emergency_contact='$emergency_contact',
    alternate_mobile='$alternate_mobile',

    address='$address',
    city='$city',
    state='$state',
    pincode='$pincode',
    country='$country',

    aadhaar='$aadhaar',
    pan='$pan',

    linkedin='$linkedin',
    github='$github',
    instagram='$instagram',
    portfolio='$portfolio'

    WHERE id='$userId'"
);


// ======================================
// REDIRECT
// ======================================

if($query){

    header("Location: profile.php?success=1");
    exit();

}else{

    die("Database Error: " . mysqli_error($conn));

}

?>