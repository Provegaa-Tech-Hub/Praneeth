<?php
session_start();

require_once("../database/db.php");

if (!isset($_SESSION['user_id'])) {

    header("Location: ../login.php");

    exit();

}

$userId = $_SESSION['user_id'];

if (!isset($_GET['id'])) {

    header("Location: index.php");

    exit();

}

$examId = (int)$_GET['id'];

/* ==========================================
GET EXAM
========================================== */

$examQuery = mysqli_query(

$conn,

"SELECT *
FROM mock_exams
WHERE id='$examId'
AND status='Active'"

);

if(mysqli_num_rows($examQuery)==0){

die("Exam not found.");

}

$exam = mysqli_fetch_assoc($examQuery);

/* ==========================================
GET QUESTIONS
========================================== */

$questionQuery = mysqli_query(

$conn,

"SELECT *
FROM mock_questions
WHERE exam_id='$examId'
ORDER BY id ASC"

);

$totalQuestions = mysqli_num_rows($questionQuery);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

<?php echo htmlspecialchars($exam['exam_name']); ?>

</title>

<link
rel="stylesheet"
href="../assets/css/exam.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="exam-container">

<div class="exam-header">

<div>

<h1>

<?php echo htmlspecialchars($exam['exam_name']); ?>

</h1>

<p>

<?php echo htmlspecialchars($exam['category']); ?>

</p>

</div>

<div class="timer">

<i class="fa-solid fa-clock"></i>

<span id="timer">

<?php echo $exam['duration']; ?>:00

</span>

</div>

</div>

<!-- ==========================================
PROGRESS
========================================== -->

<div class="progress-bar">

<div
class="progress-fill"
id="progressFill">

</div>

</div>

<form

id="examForm"

action="submit-exam.php"

method="POST">

<input
type="hidden"
name="exam_id"
value="<?php echo $examId; ?>">
<?php

$questionNo = 1;

while($question = mysqli_fetch_assoc($questionQuery)){

?>

<div class="question-card"

<?php

if($questionNo != 1){

echo 'style="display:none;"';

}

?>

>

    <div class="question-number">

        Question <?php echo $questionNo; ?>

        of

        <?php echo $totalQuestions; ?>

    </div>

    <h2 class="question-title">

        <?php echo htmlspecialchars($question['question']); ?>

    </h2>

    <div class="options">

        <label class="option">

            <input

            type="radio"

            name="answer[<?php echo $question['id']; ?>]"

            value="A">

            <span>

                <?php echo htmlspecialchars($question['option_a']); ?>

            </span>

        </label>

        <label class="option">

            <input

            type="radio"

            name="answer[<?php echo $question['id']; ?>]"

            value="B">

            <span>

                <?php echo htmlspecialchars($question['option_b']); ?>

            </span>

        </label>

        <label class="option">

            <input

            type="radio"

            name="answer[<?php echo $question['id']; ?>]"

            value="C">

            <span>

                <?php echo htmlspecialchars($question['option_c']); ?>

            </span>

        </label>

        <label class="option">

            <input

            type="radio"

            name="answer[<?php echo $question['id']; ?>]"

            value="D">

            <span>

                <?php echo htmlspecialchars($question['option_d']); ?>

            </span>

        </label>

    </div>

</div>

<?php

$questionNo++;

}

?>
<!-- ==========================================
NAVIGATION BUTTONS
========================================== -->

<div class="exam-navigation">

    <button
        type="button"
        id="prevBtn"
        class="prev-btn"
        style="display:none;">

        <i class="fa-solid fa-arrow-left"></i>

        Previous

    </button>

    <button
        type="button"
        id="nextBtn"
        class="next-btn">

        Next

        <i class="fa-solid fa-arrow-right"></i>

    </button>

    <button
        type="submit"
        id="submitBtn"
        class="submit-btn"
        style="display:none;">

        <i class="fa-solid fa-paper-plane"></i>

        Submit Exam

    </button>

</div>

</form>

<!-- ==========================================
FOOTER
========================================== -->

<footer class="exam-footer">

    <p>

        © <?php echo date("Y"); ?>

        CareerForge Recruitment Portal.

        All Rights Reserved.

    </p>

</footer>

</div>

<script>

const TOTAL_QUESTIONS = <?php echo $totalQuestions; ?>;

const EXAM_DURATION = <?php echo (int)$exam['duration']; ?>;

</script>

<script src="../assets/js/exam.js"></script>

</body>

</html>