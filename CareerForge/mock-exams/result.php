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


$resultId = (int)$_GET['id'];



/* ==========================================
GET RESULT DETAILS
========================================== */


$resultQuery = mysqli_query(

$conn,

"SELECT 

exam_results.*,

mock_exams.exam_name,

mock_exams.category,

mock_exams.total_marks

FROM exam_results

INNER JOIN mock_exams

ON exam_results.exam_id = mock_exams.id

WHERE exam_results.id='$resultId'

AND exam_results.user_id='$userId'"

);



if(mysqli_num_rows($resultQuery)==0){

    die("Result not found.");

}



$result = mysqli_fetch_assoc($resultQuery);



/* ==========================================
STATUS
========================================== */


if($result['percentage'] >= 40){

    $status = "PASS";

    $statusClass = "pass";

}
else{

    $status = "FAIL";

    $statusClass = "fail";

}


?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">


<title>

Exam Result | CareerForge

</title>


<link rel="stylesheet"
href="../assets/css/result.css">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


</head>


<body>


<div class="container">



<!-- HEADER -->

<div class="result-header">


<i class="fa-solid fa-chart-line"></i>


<h1>

Exam Result

</h1>


<p>

Your performance summary

</p>


</div>




<!-- RESULT CARD -->


<div class="result-card">



<div class="exam-title">


<h2>

<?php echo htmlspecialchars($result['exam_name']); ?>

</h2>


<span>

<?php echo htmlspecialchars($result['category']); ?>

</span>


</div>




<!-- SCORE -->


<div class="score-circle">


<h1>

<?php echo $result['percentage']; ?>%

</h1>


<p>

Score

</p>


</div>





<!-- STATUS -->


<div class="status <?php echo $statusClass; ?>">


<i class="fa-solid fa-circle-check"></i>


<?php echo $status; ?>


</div>





<!-- DETAILS -->


<div class="result-grid">



<div class="box">

<i class="fa-solid fa-list"></i>

<h3>Total Questions</h3>

<p>

<?php echo $result['total_questions']; ?>

</p>

</div>





<div class="box">

<i class="fa-solid fa-check"></i>

<h3>Correct Answers</h3>

<p>

<?php echo $result['correct_answers']; ?>

</p>

</div>





<div class="box">

<i class="fa-solid fa-star"></i>

<h3>Marks</h3>

<p>

<?php echo $result['marks']; ?>

/

<?php echo $result['total_marks']; ?>

</p>

</div>





<div class="box">

<i class="fa-solid fa-calendar"></i>

<h3>Date</h3>

<p>

<?php

echo date(

"d M Y",

strtotime($result['submitted_date'])

);

?>

</p>

</div>



</div>






<!-- BUTTONS -->


<div class="actions">



<a href="index.php"
class="back-btn">


<i class="fa-solid fa-arrow-left"></i>


Back To Exams


</a>





<a href="#"
onclick="window.print()"
class="print-btn">


<i class="fa-solid fa-print"></i>


Print Result


</a>



</div>



</div>




<footer>


© <?php echo date("Y"); ?>

CareerForge Recruitment Portal.

All Rights Reserved.


</footer>



</div>


</body>

</html>