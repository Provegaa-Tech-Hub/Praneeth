<?php

session_start();

require_once("../database/db.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: ../login.php");
    exit();

}

$userId = $_SESSION['user_id'];

/* ==========================================
GET USER DETAILS
========================================== */

$userQuery = mysqli_query(

    $conn,

    "SELECT * FROM users
     WHERE id='$userId'"

);

if(mysqli_num_rows($userQuery)==0){

    die("User not found.");

}

$user = mysqli_fetch_assoc($userQuery);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Choose Resume Template | CareerForge

</title>

<link rel="stylesheet"
href="../assets/css/templates.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="container">

<!-- ==========================================
HEADER
========================================== -->

<header class="page-header">

<div class="header-left">

<h1>

<i class="fa-solid fa-file-lines"></i>

Choose Resume Template

</h1>

<p>

Select one professional resume template for your profile.

</p>

</div>

<div class="header-right">

<img
src="../assets/images/profile/<?php

echo !empty($user['profile_photo'])

? htmlspecialchars($user['profile_photo'])

: "default.png";

?>"

alt="Profile">

<div>

<h3>

<?php echo htmlspecialchars($user['full_name']); ?>

</h3>

<p>

<?php

echo !empty($user['career_choice'])

? htmlspecialchars($user['career_choice'])

: "Candidate";

?>

</p>

</div>

</div>

</header>

<!-- ==========================================
SUCCESS MESSAGE
========================================== -->

<?php

if(isset($_SESSION['success'])){

?>

<div class="success-message">

<i class="fa-solid fa-circle-check"></i>

<?php

echo $_SESSION['success'];

unset($_SESSION['success']);

?>

</div>

<?php

}

?>

<!-- ==========================================
TITLE
========================================== -->

<div class="title-box">

<h2>

Choose Your Resume Design

</h2>

<p>

Select one resume template.
You can change it anytime.

</p>

</div>

<!-- ==========================================
TEMPLATE GRID
========================================== -->

<div class="template-grid">


<!-- ==========================================
TEMPLATE 1
========================================== -->

<div class="template-card">

    <div class="template-image">

        <img
        src="../assets/images/resume/template1.png"
        alt="Professional Resume">

    </div>

    <div class="template-content">

        <h2>

            Professional Resume

        </h2>

        <p>

            ATS Friendly Resume with a clean professional layout.
            Best suited for IT, Software, MNC and Corporate jobs.

        </p>

    </div>

    <div class="template-buttons">

        <!-- Preview Resume -->

        <a
        href="template1.php"
        class="preview-btn">

            <i class="fa-solid fa-eye"></i>

            View Resume

        </a>

        <!-- Select Resume -->

        <a
        href="save-template.php?template=1"
        class="use-btn <?php echo ($user['resume_template']==1)?'active-template':''; ?>">

            <i class="fa-solid fa-circle-check"></i>

            <?php

            if($user['resume_template']==1){

                echo "Selected";

            }else{

                echo "Use Template";

            }

            ?>

        </a>

    </div>

</div>

<!-- ==========================================
TEMPLATE 2
========================================== -->

<div class="template-card">

    <div class="template-image">

        <img
        src="../assets/images/resume/template2.png"
        alt="Modern Resume">

    </div>

    <div class="template-content">

        <h2>

            Modern Resume

        </h2>

        <p>

            Modern two-column layout with icons and a stylish design.
            Perfect for freshers and experienced professionals.

        </p>

    </div>

    <div class="template-buttons">

        <!-- Preview Resume -->

        <a
        href="template2.php"
        class="preview-btn">

            <i class="fa-solid fa-eye"></i>

            View Resume

        </a>

        <!-- Select Resume -->

        <a
        href="save-template.php?template=2"
        class="use-btn <?php echo ($user['resume_template']==2)?'active-template':''; ?>">

            <i class="fa-solid fa-circle-check"></i>

            <?php

            if($user['resume_template']==2){

                echo "Selected";

            }else{

                echo "Use Template";

            }

            ?>

        </a>

    </div>

</div>

<!-- ==========================================
TEMPLATE 3
========================================== -->

<div class="template-card">

    <div class="template-image">

        <img
        src="../assets/images/resume/template3.png"
        alt="Executive Resume">

    </div>

    <div class="template-content">

        <h2>

            Executive Resume

        </h2>

        <p>

            Premium executive layout with an elegant professional design.
            Recommended for senior professionals and management roles.

        </p>

    </div>

    <div class="template-buttons">

        <!-- Preview Resume -->

        <a
        href="template3.php"
        class="preview-btn">

            <i class="fa-solid fa-eye"></i>

            View Resume

        </a>

        <!-- Select Resume -->

        <a
        href="save-template.php?template=3"
        class="use-btn <?php echo ($user['resume_template']==3)?'active-template':''; ?>">

            <i class="fa-solid fa-circle-check"></i>

            <?php

            if($user['resume_template']==3){

                echo "Selected";

            }else{

                echo "Use Template";

            }

            ?>

        </a>

    </div>

</div>

</div>

<!-- ==========================================
BACK TO DASHBOARD
========================================== -->

<div class="page-actions">

    <a
    href="../dashboard/dashboard.php"
    class="dashboard-btn">

        <i class="fa-solid fa-house"></i>

        Back to Dashboard

    </a>

</div>

<!-- ==========================================
FOOTER
========================================== -->

<footer class="page-footer">

    <p>

        © <?php echo date("Y"); ?>

        CareerForge Recruitment Portal.

        All Rights Reserved.

    </p>

</footer>

</div>

<!-- ==========================================
JAVASCRIPT
========================================== -->

<script src="../assets/js/templates.js"></script>

</body>

</html>