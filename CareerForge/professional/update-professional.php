<?php

session_start();

require_once("../database/db.php");


if (!isset($_SESSION['user_id'])) {

    header("Location: ../login.php");

    exit();

}


$userId = $_SESSION['user_id'];



if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: professional-profile.php");

    exit();

}



// ==========================================
// BASIC DETAILS
// ==========================================

$professional_type = mysqli_real_escape_string(

    $conn,

    $_POST['professional_type'] ?? ""

);




// ==========================================
// PROFESSIONAL CATEGORY (IT / NON-IT)
// ==========================================

$professional_category = mysqli_real_escape_string(
    $conn,
    $_POST['professional_category'] ?? ""
);


$professional_id = "";

// ==========================================
// GENERATE PROFESSIONAL ID
// ==========================================

if ($professional_category == "IT") {

    $prefix = "IT";

} elseif ($professional_category == "Non-IT") {

    $prefix = "NIT";

} else {

    $prefix = "";

}

$professional_id = "";

if ($prefix != "") {

    $lastQuery = mysqli_query(

        $conn,

        "SELECT professional_id
         FROM users
         WHERE professional_id LIKE '$prefix%'
         ORDER BY id DESC
         LIMIT 1"

    );

    if (mysqli_num_rows($lastQuery) > 0) {

        $last = mysqli_fetch_assoc($lastQuery);

        $lastNumber = preg_replace('/[^0-9]/', '', $last['professional_id']);

        $newNumber = intval($lastNumber) + 1;

        $professional_id = $prefix . str_pad($newNumber, 3, "0", STR_PAD_LEFT);

    } else {

        $professional_id = $prefix . "001";

    }

}


// ==========================================
// FRESHER DETAILS
// ==========================================


$career_objective = mysqli_real_escape_string(

    $conn,

    $_POST['career_objective'] ?? ""

);



$technical_skills = mysqli_real_escape_string(

    $conn,

    $_POST['technical_skills'] ?? ""

);



$soft_skills = mysqli_real_escape_string(

    $conn,

    $_POST['soft_skills'] ?? ""

);



$projects = mysqli_real_escape_string(

    $conn,

    $_POST['projects'] ?? ""

);



$internship = mysqli_real_escape_string(

    $conn,

    $_POST['internship'] ?? ""

);



$languages = mysqli_real_escape_string(

    $conn,

    $_POST['languages'] ?? ""

);



$relocate = mysqli_real_escape_string(

    $conn,

    $_POST['relocate'] ?? ""

);




// ==========================================
// JOB DETAILS
// ==========================================


$job_role = mysqli_real_escape_string(

    $conn,

    $_POST['job_role'] ?? ""

);



$preferred_location = mysqli_real_escape_string(

    $conn,

    $_POST['preferred_location'] ?? ""

);



$expected_ctc = mysqli_real_escape_string(

    $conn,

    $_POST['expected_ctc'] ?? ""

);




// ==========================================
// EXPERIENCE DETAILS
// ==========================================


$current_company = mysqli_real_escape_string(

    $conn,

    $_POST['current_company'] ?? ""

);



$designation = mysqli_real_escape_string(

    $conn,

    $_POST['designation'] ?? ""

);



$total_experience = mysqli_real_escape_string(

    $conn,

    $_POST['total_experience'] ?? ""

);



$relevant_experience = mysqli_real_escape_string(

    $conn,

    $_POST['relevant_experience'] ?? ""

);



$current_ctc = mysqli_real_escape_string(

    $conn,

    $_POST['current_ctc'] ?? ""

);



$notice_period = mysqli_real_escape_string(

    $conn,

    $_POST['notice_period'] ?? ""

);



$current_location = mysqli_real_escape_string(

    $conn,

    $_POST['current_location'] ?? ""

);



$previous_companies = mysqli_real_escape_string(

    $conn,

    $_POST['previous_companies'] ?? ""

);



$responsibilities = mysqli_real_escape_string(

    $conn,

    $_POST['responsibilities'] ?? ""

);



$achievements = mysqli_real_escape_string(

    $conn,

    $_POST['achievements'] ?? ""

);




// ==========================================
// CLEAR EXPERIENCE DETAILS FOR FRESHER
// ==========================================


if ($professional_type == "Fresher") {


    $current_company = "";

    $designation = "";

    $total_experience = "";

    $relevant_experience = "";

    $current_ctc = "";

    $notice_period = "";

    $current_location = "";

    $previous_companies = "";

    $responsibilities = "";

    $achievements = "";


}




// ==========================================
// RESUME UPLOAD
// ==========================================


$resume = "";


$getResume = mysqli_query(

    $conn,

    "SELECT resume 
     FROM users 
     WHERE id='$userId'"

);


$user = mysqli_fetch_assoc($getResume);



$resume = $user['resume'] ?? "";



if (

    isset($_FILES['resume']) &&

    $_FILES['resume']['error'] == 0

) {


    $uploadDir = "../assets/uploads/resume/";



    if (!is_dir($uploadDir)) {


        mkdir($uploadDir,0777,true);


    }



    $extension = strtolower(

        pathinfo(

            $_FILES["resume"]["name"],

            PATHINFO_EXTENSION

        )

    );



    $allowed = [

        "pdf",

        "doc",

        "docx"

    ];



    if (in_array($extension,$allowed)) {


        $resume = time() . "_" .

        basename($_FILES["resume"]["name"]);



        move_uploaded_file(

            $_FILES["resume"]["tmp_name"],

            $uploadDir . $resume

        );


    }


}


// ==========================================
// UPDATE PROFESSIONAL PROFILE
// ==========================================


$updateQuery = mysqli_query(

$conn,

"UPDATE users SET

professional_type='$professional_type',

professional_category='$professional_category',

professional_id='$professional_id',


career_objective='$career_objective',

technical_skills='$technical_skills',

soft_skills='$soft_skills',

projects='$projects',

internship='$internship',

languages='$languages',

relocate='$relocate',


job_role='$job_role',

preferred_location='$preferred_location',

expected_ctc='$expected_ctc',


current_company='$current_company',

designation='$designation',

total_experience='$total_experience',

relevant_experience='$relevant_experience',

current_ctc='$current_ctc',

notice_period='$notice_period',

current_location='$current_location',

previous_companies='$previous_companies',

responsibilities='$responsibilities',

achievements='$achievements',


resume='$resume'


WHERE id='$userId'"

);



// ==========================================
// SUCCESS / ERROR
// ==========================================


if($updateQuery){


    echo "

    <script>

    alert('Professional Profile Updated Successfully');

    window.location='professional-profile.php';
    </script>

    ";


}

else{


    echo "

    <script>

    alert('Profile Update Failed');

    window.history.back();

    </script>

    ";


}

?>