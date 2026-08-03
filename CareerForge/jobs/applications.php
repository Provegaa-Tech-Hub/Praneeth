<?php

session_start();

require_once("../database/db.php");


if (!isset($_SESSION['user_id'])) {

    header("Location: ../login.php");
    exit();

}


$userId = $_SESSION['user_id'];



/* ==========================================
GET USER APPLICATIONS
========================================== */


$applications = mysqli_query(

    $conn,

    "SELECT 

    applications.*,

    jobs.job_title,
    jobs.company_name,
    jobs.location,
    jobs.salary,
    jobs.company_logo

    FROM applications

    INNER JOIN jobs

    ON applications.job_id = jobs.id

    WHERE applications.user_id='$userId'

    ORDER BY applications.applied_date DESC"

);


?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>

My Applications | CareerForge

</title>


<link rel="stylesheet"
href="../assets/css/my-applications.css">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


</head>


<body>


<div class="container">



<!-- PAGE HEADER -->

<div class="page-header">


<h1>

<i class="fa-solid fa-file-circle-check"></i>

My Applications

</h1>


<p>

Track your job application progress

</p>


</div>




<?php


if(mysqli_num_rows($applications) > 0){



while($app = mysqli_fetch_assoc($applications)){



$logo = !empty($app['company_logo'])

?

"../assets/images/companies/".$app['company_logo']

:

"../assets/images/companies/default-company.png";



$status = $app['application_status'];



?>



<div class="application-card">



<!-- JOB HEADER -->


<div class="job-header">


<img src="<?php echo $logo; ?>">


<div>


<h2>

<?php echo htmlspecialchars($app['job_title']); ?>

</h2>


<h3>

<?php echo htmlspecialchars($app['company_name']); ?>

</h3>


<p>

<i class="fa-solid fa-location-dot"></i>

<?php echo htmlspecialchars($app['location']); ?>

</p>


</div>


</div>





<!-- APPLICATION DETAILS -->


<div class="application-details">


<div>

<i class="fa-solid fa-money-bill-wave"></i>

<?php echo htmlspecialchars($app['salary']); ?>

</div>



<div>

<i class="fa-solid fa-calendar-days"></i>

Applied Date :

<?php

echo date(
"d M Y",
strtotime($app['applied_date'])
);

?>

</div>


</div>





<!-- STATUS TRACKER -->


<div class="status-box">


<h3>

Application Status

</h3>



<div class="status-track">



<div class="status-step active">

<span>

<i class="fa-solid fa-check"></i>

</span>


<p>

Applied

</p>


</div>





<div class="status-line"></div>





<div class="status-step

<?php

if(
$status=="Under Review" ||
$status=="Interview" ||
$status=="Selected"
)

echo " active";

?>

">


<span>

<i class="fa-solid fa-eye"></i>

</span>


<p>

Review

</p>


</div>





<div class="status-line"></div>





<div class="status-step

<?php

if(
$status=="Interview" ||
$status=="Selected"
)

echo " active";

?>

">


<span>

<i class="fa-solid fa-user-tie"></i>

</span>


<p>

Interview

</p>


</div>





<div class="status-line"></div>





<div class="status-step

<?php

if($status=="Selected")

echo " active";

?>

">


<span>

<i class="fa-solid fa-star"></i>

</span>


<p>

Selected

</p>


</div>



</div>


</div>





<!-- FOOTER -->


<div class="application-footer">


<span class="current-status">

<?php echo htmlspecialchars($status); ?>

</span>



<a href="job-details.php?id=<?php echo $app['job_id']; ?>">

<i class="fa-solid fa-eye"></i>

View Job

</a>


</div>




</div>



<?php


}


}

else{


?>



<div class="no-applications">


<i class="fa-solid fa-folder-open"></i>


<h2>

No Applications Yet

</h2>


<p>

You have not applied for any jobs.

</p>



<a href="available-jobs.php">

Browse Jobs

</a>



</div>



<?php


}


?>



</div>



</body>

</html>