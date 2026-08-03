<?php

session_start();

require_once("../database/db.php");

if(!isset($_SESSION['user_id'])){

    header("Location: ../login.php");

    exit();

}

$userId=$_SESSION['user_id'];

/* ==========================================
GET USER
========================================== */

$userQuery=mysqli_query(

$conn,

"SELECT * FROM users
WHERE id='$userId'"

);

if(mysqli_num_rows($userQuery)==0){

die("Candidate not found.");

}

$user=mysqli_fetch_assoc($userQuery);

/* ==========================================
MOCK SCORECARD
========================================== */

$scoreQuery = mysqli_query(

$conn,

"SELECT

COUNT(*) AS total_exams,

MAX(percentage) AS highest,

AVG(percentage) AS overall

FROM exam_results

WHERE user_id='$userId'"

);

$score = mysqli_fetch_assoc($scoreQuery);

$totalExams = $score['total_exams'] ?? 0;

$highest = round($score['highest'] ?? 0);

$overall = round($score['overall'] ?? 0);

if($overall >= 90){

    $rating = "Outstanding";
    $status = "PASS";

}
elseif($overall >= 75){

    $rating = "Excellent";
    $status = "PASS";

}
elseif($overall >= 60){

    $rating = "Good";
    $status = "PASS";

}
elseif($overall >= 40){

    $rating = "Average";
    $status = "PASS";

}
else{

    $rating = "Needs Improvement";
    $status = "FAILED";

}

/* ==========================================
GET EDUCATION
========================================== */

$educationQuery=mysqli_query(

$conn,

"SELECT *
FROM candidate_education
WHERE user_id='$userId'
ORDER BY id DESC"

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

Modern Resume

</title>

<link
rel="stylesheet"
href="../assets/css/template2.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="resume">

<!-- ==========================================
LEFT SIDEBAR
========================================== -->

<div class="left">

<div class="photo">

<img

src="../assets/images/profile/<?php

echo !empty($user['profile_photo'])

? htmlspecialchars($user['profile_photo'])

: "default.png";

?>"

alt="Profile">

</div>

<h2>

<?php echo htmlspecialchars($user['full_name']); ?>

</h2>

<h4>

<?php

echo !empty($user['job_role'])

? htmlspecialchars($user['job_role'])

: "Candidate";

?>

</h4>

<div class="section">

<h3>

Contact

</h3>

<p>

<i class="fa-solid fa-envelope"></i>

<?php echo htmlspecialchars($user['email']); ?>

</p>

<p>

<i class="fa-solid fa-phone"></i>

<?php echo htmlspecialchars($user['mobile']); ?>

</p>

<p>

<i class="fa-solid fa-location-dot"></i>

<?php echo htmlspecialchars($user['current_location']); ?>

</p>

</div>




<!-- ==========================================
SKILLS
========================================== -->

<div class="section">

<h3>

Technical Skills

</h3>

<p>

<?php

echo !empty($user['primary_skills'])

? nl2br(htmlspecialchars($user['primary_skills']))

: "Not Added";

?>

</p>

</div>
<!-- ==========================================
MOCK SCORECARD
========================================== -->

<div class="section mock-score">

<h3>

<i class="fa-solid fa-award"></i>

Mock Scorecard

</h3>

<div class="score-circle">

<?php echo $overall; ?>%

</div>

<p>

<strong>Rating</strong><br>

<?php echo $rating; ?>

</p>

<p>

<strong>Exams Attended</strong><br>

<?php echo $totalExams; ?>

</p>

<p>

<strong>Highest Score</strong><br>

<?php echo $highest; ?>%

</p>

<p>

<strong>Status</strong><br>

<span class="status-badge">

<?php echo $status; ?>

</span>

</p>

</div>
<!-- ==========================================
SECONDARY SKILLS
========================================== -->

<div class="section">

<h3>

Secondary Skills

</h3>

<p>

<?php

echo !empty($user['secondary_skills'])

? nl2br(htmlspecialchars($user['secondary_skills']))

: "Not Added";

?>

</p>

</div>

<!-- ==========================================
LANGUAGES
========================================== -->

<div class="section">

<h3>

Languages

</h3>

<p>

<?php

echo !empty($user['languages'])

? htmlspecialchars($user['languages'])

: "Not Added";

?>

</p>

</div>

<!-- ==========================================
CERTIFICATIONS
========================================== -->

<div class="section">

<h3>

Certifications

</h3>

<p>

<?php

echo !empty($user['certifications'])

? nl2br(htmlspecialchars($user['certifications']))

: "Not Added";

?>

</p>

</div>

<!-- ==========================================
SOCIAL LINKS
========================================== -->

<div class="section">

<h3>

Profiles

</h3>

<p>

<i class="fa-brands fa-linkedin"></i>

<?php

echo !empty($user['linkedin'])

? htmlspecialchars($user['linkedin'])

: "-";

?>

</p>

<p>

<i class="fa-brands fa-github"></i>

<?php

echo !empty($user['github'])

? htmlspecialchars($user['github'])

: "-";

?>

</p>

<p>

<i class="fa-solid fa-globe"></i>

<?php

echo !empty($user['portfolio'])

? htmlspecialchars($user['portfolio'])

: "-";

?>

</p>

</div>


</div>

<!-- ==========================================
RIGHT CONTENT
========================================== -->

<div class="right">

<div class="resume-title">

<h1>

<?php echo htmlspecialchars($user['full_name']); ?>

</h1>

<h3>

<?php

echo !empty($user['job_role'])

? htmlspecialchars($user['job_role'])

: "Candidate";

?>

</h3>

</div>



<!-- ==========================================
CAREER OBJECTIVE
========================================== -->

<div class="resume-section">

<h2>

Career Objective

</h2>

<p>

<?php

echo !empty($user['career_objective'])

? nl2br(htmlspecialchars($user['career_objective']))

: "Career objective not available.";

?>

</p>

</div>

<!-- ==========================================
PERSONAL INFORMATION
========================================== -->

<div class="resume-section">

<h2>

Personal Information

</h2>

<table class="info-table">

<tr>

<td><strong>Date of Birth</strong></td>

<td>

<?php

echo !empty($user['dob'])

? date("d M Y",strtotime($user['dob']))

: "-";

?>

</td>

</tr>

<tr>

<td><strong>Gender</strong></td>

<td><?php echo htmlspecialchars($user['gender']); ?></td>

</tr>

<tr>

<td><strong>Nationality</strong></td>

<td><?php echo htmlspecialchars($user['nationality']); ?></td>

</tr>

<tr>

<td><strong>Marital Status</strong></td>

<td><?php echo htmlspecialchars($user['marital_status']); ?></td>

</tr>

<tr>

<td><strong>Address</strong></td>

<td>

<?php

echo htmlspecialchars($user['address']);

echo ", ";

echo htmlspecialchars($user['city']);

echo ", ";

echo htmlspecialchars($user['state']);

echo ", ";

echo htmlspecialchars($user['country']);

?>

</td>

</tr>

</table>

</div>

<!-- ==========================================
EDUCATION
========================================== -->

<div class="resume-section">

<h2>Education</h2>

<?php

if(mysqli_num_rows($educationQuery)>0){

$edu = mysqli_fetch_assoc($educationQuery);

?>

<!-- ==========================
10TH CLASS
========================== -->

<div class="education-box">

<h3>10th Class</h3>

<p>
<strong>School :</strong>
<?php echo htmlspecialchars($edu['school_name']); ?>
</p>

<p>
<strong>Board :</strong>
<?php echo htmlspecialchars($edu['board']); ?>
</p>

<p>
<strong>Passing Year :</strong>
<?php echo htmlspecialchars($edu['tenth_year']); ?>
</p>

<p>
<strong>Percentage :</strong>
<?php echo htmlspecialchars($edu['tenth_percentage']); ?>%
</p>

</div>

<!-- ==========================
INTERMEDIATE / DIPLOMA
========================== -->

<div class="education-box">

<h3><?php echo htmlspecialchars($edu['qualification']); ?></h3>

<p>
<strong>College :</strong>
<?php echo htmlspecialchars($edu['college_name']); ?>
</p>

<p>
<strong>Course :</strong>
<?php echo htmlspecialchars($edu['course']); ?>
</p>

<p>
<strong>Passing Year :</strong>
<?php echo htmlspecialchars($edu['inter_year']); ?>
</p>

<p>
<strong>Percentage :</strong>
<?php echo htmlspecialchars($edu['inter_percentage']); ?>%
</p>

</div>
<!-- ==========================
GRADUATION
========================== -->

<?php if(!empty($edu['degree'])){ ?>

<div class="education-box">

<h3>Graduation</h3>

<p>
<strong>Degree :</strong>
<?php echo htmlspecialchars($edu['degree']); ?>
</p>

<p>
<strong>University :</strong>
<?php echo htmlspecialchars($edu['university']); ?>
</p>

<p>
<strong>Branch :</strong>
<?php echo htmlspecialchars($edu['branch']); ?>
</p>

<p>
<strong>Passing Year :</strong>
<?php echo htmlspecialchars($edu['graduation_year']); ?>
</p>

<p>
<strong>Percentage :</strong>
<?php echo htmlspecialchars($edu['graduation_percentage']); ?>%
</p>

<p>
<strong>Status :</strong>
<?php echo htmlspecialchars($edu['graduation_status']); ?>
</p>

</div>

<?php } ?>


<!-- ==========================
POST GRADUATION
========================== -->

<?php if(!empty($edu['post_graduation'])){ ?>

<div class="education-box">

<h3>Post Graduation</h3>

<p>
<strong>Course :</strong>
<?php echo htmlspecialchars($edu['post_graduation']); ?>
</p>

<p>
<strong>Percentage :</strong>
<?php echo htmlspecialchars($edu['pg_percentage']); ?>%
</p>

</div>

<?php } ?>


<?php

}else{

?>

<p>No education details found.</p>

<?php

}

?>

</div>

<!-- ==========================================
PROJECTS
========================================== -->

<div class="resume-section">

<h2>

Projects

</h2>

<p>

<?php

echo !empty($user['projects'])

? nl2br(htmlspecialchars($user['projects']))

: "No projects added.";

?>

</p>

</div>


<!-- ==========================================
INTERNSHIP
========================================== -->

<div class="resume-section">

<h2>

Internship

</h2>

<p>

<?php

echo !empty($user['internship'])

? nl2br(htmlspecialchars($user['internship']))

: "No internship details available.";

?>

</p>

</div>

<!-- ==========================================
WORK EXPERIENCE
========================================== -->

<div class="resume-section">

<h2>

Work Experience

</h2>

<?php

if(!empty($user['current_company'])){

?>

<table class="info-table">

<tr>

<td><strong>Current Company</strong></td>

<td><?php echo htmlspecialchars($user['current_company']); ?></td>

</tr>

<tr>

<td><strong>Designation</strong></td>

<td><?php echo htmlspecialchars($user['designation']); ?></td>

</tr>

<tr>

<td><strong>Total Experience</strong></td>

<td><?php echo htmlspecialchars($user['total_experience']); ?></td>

</tr>

<tr>

<td><strong>Relevant Experience</strong></td>

<td><?php echo htmlspecialchars($user['relevant_experience']); ?></td>

</tr>

<tr>

<td><strong>Current CTC</strong></td>

<td><?php echo htmlspecialchars($user['current_ctc']); ?></td>

</tr>

<tr>

<td><strong>Notice Period</strong></td>

<td><?php echo htmlspecialchars($user['notice_period']); ?></td>

</tr>

</table>

<?php

}else{

echo "<p>Fresher - No work experience available.</p>";

}

?>

</div>

<!-- ==========================================
RESPONSIBILITIES
========================================== -->

<div class="resume-section">

<h2>

Responsibilities

</h2>

<p>

<?php

echo !empty($user['responsibilities'])

? nl2br(htmlspecialchars($user['responsibilities']))

: "Not Available";

?>

</p>

</div>

<!-- ==========================================
ACHIEVEMENTS
========================================== -->

<div class="resume-section">

<h2>

Achievements

</h2>

<p>

<?php

echo !empty($user['achievements'])

? nl2br(htmlspecialchars($user['achievements']))

: "No achievements added.";

?>

</p>

</div>

<!-- ==========================================
JOB PREFERENCES
========================================== -->

<div class="resume-section">

<h2>

Job Preferences

</h2>

<table class="info-table">

<tr>

<td><strong>Preferred Job Role</strong></td>

<td><?php echo htmlspecialchars($user['job_role']); ?></td>

</tr>

<tr>

<td><strong>Preferred Industry</strong></td>

<td><?php echo htmlspecialchars($user['preferred_industry']); ?></td>

</tr>

<tr>

<td><strong>Employment Type</strong></td>

<td><?php echo htmlspecialchars($user['employment_type']); ?></td>

</tr>

<tr>

<td><strong>Work Mode</strong></td>

<td><?php echo htmlspecialchars($user['work_mode']); ?></td>

</tr>

<tr>

<td><strong>Preferred Location</strong></td>

<td><?php echo htmlspecialchars($user['preferred_location']); ?></td>

</tr>

<tr>

<td><strong>Expected CTC</strong></td>

<td><?php echo htmlspecialchars($user['expected_ctc']); ?></td>

</tr>

</table>

</div>

<!-- ==========================================
DECLARATION
========================================== -->

<div class="resume-section">

<h2>

Declaration

</h2>

<p>

I hereby declare that the information provided above is true and correct to the best of my knowledge and belief.

</p>

</div>

<!-- ==========================================
ACTION BUTTONS
========================================== -->

<div class="resume-actions">

<button
onclick="window.print()"
class="print-btn">

<i class="fa-solid fa-print"></i>

Print Resume

</button>

<a
href="templates.php"
class="back-btn">

<i class="fa-solid fa-arrow-left"></i>

Back

</a>

<a
href="../dashboard/dashboard.php"
class="dashboard-btn">

<i class="fa-solid fa-house"></i>

Dashboard

</a>

</div>

</div>

</div>

<script src="../assets/js/template2.js"></script>

</body>

</html>