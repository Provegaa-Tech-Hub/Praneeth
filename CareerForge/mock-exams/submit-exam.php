<?php

session_start();

require_once("../database/db.php");


if (!isset($_SESSION['user_id'])) {

    header("Location: ../login.php");

    exit();

}


$userId = $_SESSION['user_id'];



/* ==========================================
CHECK REQUEST
========================================== */


if($_SERVER["REQUEST_METHOD"] != "POST"){

    header("Location: index.php");

    exit();

}



/* ==========================================
GET DATA
========================================== */


$examId = (int)($_POST['exam_id'] ?? 0);


$answers = $_POST['answer'] ?? [];



if($examId == 0){

    die("Invalid Exam");

}



/* ==========================================
GET QUESTIONS
========================================== */


$questionQuery = mysqli_query(

$conn,

"SELECT *
 FROM mock_questions
 WHERE exam_id='$examId'"

);



if(!$questionQuery){

    die(mysqli_error($conn));

}



$totalQuestions = mysqli_num_rows($questionQuery);


$correctAnswers = 0;



/* ==========================================
CHECK ANSWERS
========================================== */


while($question = mysqli_fetch_assoc($questionQuery)){


    $questionId = $question['id'];


    $userAnswer = $answers[$questionId] ?? "";


    $correctAnswer = $question['correct_option'];



    if($userAnswer == $correctAnswer){

        $correctAnswers++;

    }


}



/* ==========================================
CALCULATE RESULT
========================================== */


if($totalQuestions > 0){

    $percentage = round(

        ($correctAnswers / $totalQuestions) * 100

    );

}
else{

    $percentage = 0;

}



$marks = $correctAnswers;



if($percentage >= 70){

    $status = "Passed";

}
else{

    $status = "Failed";

}



/* ==========================================
CHECK OLD RESULT
========================================== */


$check = mysqli_query(

$conn,

"SELECT id
 FROM exam_results
 WHERE user_id='$userId'
 AND exam_id='$examId'"

);



if(mysqli_num_rows($check) > 0){


    mysqli_query(

    $conn,

    "UPDATE exam_results SET

    total_questions='$totalQuestions',

    correct_answers='$correctAnswers',

    marks='$marks',

    percentage='$percentage',

    status='$status',

    submitted_date=NOW()

    WHERE user_id='$userId'

    AND exam_id='$examId'"

    );


}

else{


    mysqli_query(

    $conn,

    "INSERT INTO exam_results

    (

    user_id,

    exam_id,

    total_questions,

    correct_answers,

    marks,

    percentage,

    status,

    submitted_date

    )

    VALUES

    (

    '$userId',

    '$examId',

    '$totalQuestions',

    '$correctAnswers',

    '$marks',

    '$percentage',

    '$status',

    NOW()

    )"

    );


}



/* ==========================================
GET RESULT ID
========================================== */


$resultQuery = mysqli_query(

$conn,

"SELECT id

 FROM exam_results

 WHERE user_id='$userId'

 AND exam_id='$examId'

 ORDER BY id DESC

 LIMIT 1"

);



if(!$resultQuery){

    die(mysqli_error($conn));

}



$resultData = mysqli_fetch_assoc($resultQuery);



$resultId = $resultData['id'];



/* ==========================================
REDIRECT RESULT PAGE
========================================== */


header(

"Location: result.php?id=".$resultId

);


exit();


?>



<div class="back-dashboard">

    <a href="../dashboard/dashboard.php" class="dashboard-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Back to Dashboard

    </a>

</div>