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

    "SELECT * FROM users WHERE id='$userId'"

);

$user = mysqli_fetch_assoc($userQuery);

/* ==========================================
GET ACTIVE EXAMS
========================================== */

$examQuery = mysqli_query(

    $conn,

    "SELECT *
     FROM mock_exams
     WHERE status='Active'
     ORDER BY exam_name ASC"

);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Mock Exams | CareerForge

</title>

<link
rel="stylesheet"
href="../assets/css/mock-exams.css">

<link
rel="stylesheet"
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

<i class="fa-solid fa-laptop-code"></i>

Mock Exams

</h1>

<p>

Practice, improve your skills and get interview ready.

</p>

</div>

<div class="header-right">

<img

src="../assets/images/profile/<?php

echo !empty($user['profile_photo'])

? htmlspecialchars($user['profile_photo'])

: "default.png";

?>"

alt="Candidate">

<div>

<h3>

<?php

echo htmlspecialchars($user['full_name']);

?>

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
EXAMS GRID
========================================== -->

<div class="exam-grid">

<?php

if(mysqli_num_rows($examQuery) > 0){

while($exam = mysqli_fetch_assoc($examQuery)){

?>

<div class="exam-card">

    <div class="exam-icon">

        <i class="fa-solid fa-graduation-cap"></i>

    </div>

    <div class="exam-content">

        <h2>

            <?php echo htmlspecialchars($exam['exam_name']); ?>

        </h2>

        <span class="category">

            <?php echo htmlspecialchars($exam['category']); ?>

        </span>

    </div>

    <!-- ===========================
    EXAM DETAILS
    =========================== -->

    <div class="exam-details">

        <div class="detail-item">

            <i class="fa-regular fa-clock"></i>

            <span>

                <?php echo $exam['duration']; ?>

                Minutes

            </span>

        </div>

        <div class="detail-item">

            <i class="fa-solid fa-list-check"></i>

            <span>

                <?php echo $exam['total_questions']; ?>

                Questions

            </span>

        </div>

        <div class="detail-item">

            <i class="fa-solid fa-star"></i>

            <span>

                <?php echo $exam['total_marks']; ?>

                Marks

            </span>

        </div>

        <div class="detail-item">

            <i class="fa-solid fa-signal"></i>

            <span>

                <?php echo htmlspecialchars($exam['difficulty']); ?>

            </span>

        </div>

    </div>

    <!-- ===========================
    DESCRIPTION
    =========================== -->

    <div class="exam-description">

        <?php

        if(!empty($exam['description'])){

            echo htmlspecialchars($exam['description']);

        }else{

            echo "Practice this mock exam to improve your interview preparation and technical knowledge.";

        }

        ?>

    </div>

        <!-- ==========================================
    ACTION BUTTONS
    ========================================== -->

    <div class="exam-footer">

        <a
        href="exam.php?id=<?php echo $exam['id']; ?>"
        class="start-btn">

            <i class="fa-solid fa-play"></i>

            Start Exam

        </a>

        <?php

$resultCheck = mysqli_query(
    $conn,
    "SELECT id
     FROM exam_results
     WHERE user_id='$userId'
     AND exam_id='".$exam['id']."'
     ORDER BY id DESC
     LIMIT 1"
);

if(mysqli_num_rows($resultCheck) > 0){

    $resultData = mysqli_fetch_assoc($resultCheck);

?>

<a href="result.php?id=<?php echo $resultData['id']; ?>"
   class="result-btn">

    <i class="fa-solid fa-chart-column"></i>

    View Results

</a>

<?php

}else{

?>

<a href="#"
   class="result-btn disabled"
   onclick="alert('You have not attempted this exam yet.'); return false;">

    <i class="fa-solid fa-chart-column"></i>

    View Results

</a>

<?php

}

?>
    </div>

</div>

<?php

}

}else{

?>

<!-- ==========================================
NO EXAMS
========================================== -->

<div class="no-exams">

    <i class="fa-solid fa-circle-info"></i>

    <h2>

        No Mock Exams Available

    </h2>

    <p>

        There are currently no active mock exams.
        Please check back later.

    </p>

</div>

<?php

}

?>

</div>

<!-- ==========================================
FOOTER
========================================== -->

<footer class="page-footer">

    <div class="footer-content">

        <p>

            © <?php echo date("Y"); ?>

            CareerForge Recruitment Portal.

            All Rights Reserved.

        </p>

    </div>

</footer>

</div>

<!-- ==========================================
JAVASCRIPT
========================================== -->

<script src="../assets/js/mock-exams.js"></script>

</body>

</html>



