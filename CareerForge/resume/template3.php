<?php

session_start();

require_once("../database/db.php");

if(!isset($_SESSION['user_id'])){

    header("Location: ../login.php");
    exit();

}

$userId=$_SESSION['user_id'];

/* ==========================================
GET USER DETAILS
========================================== */

$userQuery=mysqli_query(

$conn,

"SELECT *
FROM users
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

Executive Resume

</title>

<link
rel="stylesheet"
href="../assets/css/template3.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="resume">
<!-- ==========================================
HEADER
========================================== -->

<header class="resume-header">

    <div class="profile-photo">

        <img
        src="../assets/images/profile/<?php
        echo !empty($user['profile_photo'])
        ? htmlspecialchars($user['profile_photo'])
        : "default.png";
        ?>"
        alt="Profile">

    </div>

    <div class="header-content">

        <h1><?php echo htmlspecialchars($user['full_name']); ?></h1>

        <h3>

            <?php
            echo !empty($user['job_role'])
            ? htmlspecialchars($user['job_role'])
            : "Professional Candidate";
            ?>

        </h3>

        <p>

            <?php
            echo !empty($user['career_objective'])
            ? htmlspecialchars($user['career_objective'])
            : "Dedicated professional seeking an opportunity to contribute and grow.";
            ?>

        </p>

    </div>

    <!-- ==========================================
    MOCK SCORECARD
    ========================================== -->

    <div class="mock-card">

        <h3>
            <i class="fa-solid fa-award"></i>
            Mock Scorecard
        </h3>

        <div class="mock-grid">

            <div>

                <span>Highest</span>

                <strong><?php echo $highest; ?>%</strong>

            </div>

            <div>

                <span>Average</span>

                <strong><?php echo $overall; ?>%</strong>

            </div>

            <div>

                <span>Exams</span>

                <strong><?php echo $totalExams; ?></strong>

            </div>

            <div>

                <span>Rating</span>

                <strong><?php echo $rating; ?></strong>

            </div>

        </div>

        <div class="mock-status <?php echo ($status=="FAILED") ? "failed" : ""; ?>">

            <?php echo $status; ?>

        </div>

    </div>

</header>
<!-- ==========================================
CONTACT BAR
========================================== -->

<section class="contact-bar">

<div>

<i class="fa-solid fa-envelope"></i>

<?php echo htmlspecialchars($user['email']); ?>

</div>

<div>

<i class="fa-solid fa-phone"></i>

<?php echo htmlspecialchars($user['mobile']); ?>

</div>

<div>

<i class="fa-solid fa-location-dot"></i>

<?php echo htmlspecialchars($user['current_location']); ?>

</div>

<div>

<i class="fa-brands fa-linkedin"></i>

<?php

echo !empty($user['linkedin'])

? htmlspecialchars($user['linkedin'])

: "Not Available";

?>

</div>

</section>

<!-- ==========================================
MAIN CONTENT
========================================== -->

<div class="resume-body">

<div class="left-column">


<!-- ==========================================
PROFESSIONAL SKILLS
========================================== -->

<section class="resume-section">

<h2>

Professional Skills

</h2>

<div class="skill-box">

<h4>Primary Skills</h4>

<p>

<?php

echo !empty($user['primary_skills'])

? nl2br(htmlspecialchars($user['primary_skills']))

: "Not Available";

?>

</p>

</div>

<div class="skill-box">

<h4>Secondary Skills</h4>

<p>

<?php

echo !empty($user['secondary_skills'])

? nl2br(htmlspecialchars($user['secondary_skills']))

: "Not Available";

?>

</p>

</div>

</section>

<!-- ==========================================
LANGUAGES
========================================== -->

<section class="resume-section">

<h2>

Languages

</h2>

<p>

<?php

echo !empty($user['languages'])

? htmlspecialchars($user['languages'])

: "Not Available";

?>

</p>

</section>

<!-- ==========================================
CERTIFICATIONS
========================================== -->

<section class="resume-section">

<h2>

Certifications

</h2>

<p>

<?php

echo !empty($user['certifications'])

? nl2br(htmlspecialchars($user['certifications']))

: "No Certifications Added";

?>

</p>

</section>

<!-- ==========================================
PERSONAL INFORMATION
========================================== -->

<section class="resume-section">

<h2>

Personal Information

</h2>

<table class="info-table">

<tr>

<td>Date of Birth</td>

<td>

<?php

echo !empty($user['dob'])

? date("d M Y",strtotime($user['dob']))

: "-";

?>

</td>

</tr>

<tr>

<td>Gender</td>

<td>

<?php

echo !empty($user['gender'])

? htmlspecialchars($user['gender'])

: "-";

?>

</td>

</tr>

<tr>

<td>Nationality</td>

<td>

<?php

echo !empty($user['nationality'])

? htmlspecialchars($user['nationality'])

: "-";

?>

</td>

</tr>

<tr>

<td>Marital Status</td>

<td>

<?php

echo !empty($user['marital_status'])

? htmlspecialchars($user['marital_status'])

: "-";

?>

</td>

</tr>

<tr>

<td>Blood Group</td>

<td>

<?php

echo !empty($user['blood_group'])

? htmlspecialchars($user['blood_group'])

: "-";

?>

</td>

</tr>

</table>

</section>

<!-- ==========================================
SOCIAL PROFILES
========================================== -->

<section class="resume-section">

<h2>

Professional Profiles

</h2>

<p>

<strong>LinkedIn</strong><br>

<?php

echo !empty($user['linkedin'])

? htmlspecialchars($user['linkedin'])

: "Not Available";

?>

</p>

<br>

<p>

<strong>GitHub</strong><br>

<?php

echo !empty($user['github'])

? htmlspecialchars($user['github'])

: "Not Available";

?>

</p>

<br>

<p>

<strong>Portfolio</strong><br>

<?php

echo !empty($user['portfolio'])

? htmlspecialchars($user['portfolio'])

: "Not Available";

?>

</p>

</section>

</div>

<!-- ==========================================
RIGHT COLUMN
========================================== -->

<div class="right-column">

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
</section>
<!-- ==========================================
PROJECTS
========================================== -->

<section class="resume-section">

<h2>

Projects

</h2>

<div class="card-box">

<p>

<?php

echo !empty($user['projects'])

? nl2br(htmlspecialchars($user['projects']))

: "Projects not available.";

?>

</p>

</div>

</section>

<!-- ==========================================
INTERNSHIP
========================================== -->

<section class="resume-section">

<h2>

Internship

</h2>

<div class="card-box">

<p>

<?php

echo !empty($user['internship'])

? nl2br(htmlspecialchars($user['internship']))

: "Internship details not available.";

?>

</p>

</div>

</section>

<!-- ==========================================
WORK EXPERIENCE
========================================== -->

<section class="resume-section">

<h2>

Professional Experience

</h2>

<?php

if(!empty($user['current_company'])){

?>

<div class="experience-box">

<h3>

<?php echo htmlspecialchars($user['designation']); ?>

</h3>

<h4>

<?php echo htmlspecialchars($user['current_company']); ?>

</h4>

<p>

<strong>Total Experience :</strong>

<?php echo htmlspecialchars($user['total_experience']); ?>

</p>

<p>

<strong>Relevant Experience :</strong>

<?php echo htmlspecialchars($user['relevant_experience']); ?>

</p>

<p>

<strong>Current CTC :</strong>

<?php echo htmlspecialchars($user['current_ctc']); ?>

</p>

<p>

<strong>Notice Period :</strong>

<?php echo htmlspecialchars($user['notice_period']); ?>

</p>

</div>

<?php

}else{

?>

<div class="experience-box">

<p>

Fresher - No professional experience available.

</p>

</div>

<?php

}

?>

</section>

<!-- ==========================================
RESPONSIBILITIES
========================================== -->

<section class="resume-section">

<h2>

Roles & Responsibilities

</h2>

<div class="card-box">

<p>

<?php

echo !empty($user['responsibilities'])

? nl2br(htmlspecialchars($user['responsibilities']))

: "Responsibilities not available.";

?>

</p>

</div>

</section>

<!-- ==========================================
ACHIEVEMENTS
========================================== -->

<section class="resume-section">

<h2>

Achievements

</h2>

<div class="card-box">

<p>

<?php

echo !empty($user['achievements'])

? nl2br(htmlspecialchars($user['achievements']))

: "No achievements available.";

?>

</p>

</div>

</section>

<!-- ==========================================
JOB PREFERENCES
========================================== -->

<section class="resume-section">

<h2>

Job Preferences

</h2>

<table class="info-table">

<tr>

<td>Preferred Job Role</td>

<td>

<?php

echo !empty($user['job_role'])

? htmlspecialchars($user['job_role'])

: "-";

?>

</td>

</tr>

<tr>

<td>Preferred Industry</td>

<td>

<?php

echo !empty($user['preferred_industry'])

? htmlspecialchars($user['preferred_industry'])

: "-";

?>

</td>

</tr>

<tr>

<td>Employment Type</td>

<td>

<?php

echo !empty($user['employment_type'])

? htmlspecialchars($user['employment_type'])

: "-";

?>

</td>

</tr>

<tr>

<td>Work Mode</td>

<td>

<?php

echo !empty($user['work_mode'])

? htmlspecialchars($user['work_mode'])

: "-";

?>

</td>

</tr>

<tr>

<td>Preferred Location</td>

<td>

<?php

echo !empty($user['preferred_location'])

? htmlspecialchars($user['preferred_location'])

: "-";

?>

</td>

</tr>

<tr>

<td>Expected CTC</td>

<td>

<?php

echo !empty($user['expected_ctc'])

? htmlspecialchars($user['expected_ctc'])

: "-";

?>

</td>

</tr>

</table>

</section>

<!-- ==========================================
DECLARATION
========================================== -->

<section class="resume-section">

<h2>

Declaration

</h2>

<p>

I hereby declare that all the information furnished above is true and correct to the best of my knowledge and belief. I understand that any false information may result in the cancellation of my candidature.

</p>

</section>

<!-- ==========================================
SIGNATURE
========================================== -->

<section class="signature-section">

<div class="signature-box">

<p>

Date :
<strong>

<?php echo date("d M Y"); ?>

</strong>

</p>

<br>

<p>

Place :

<strong>

<?php

echo !empty($user['current_location'])

? htmlspecialchars($user['current_location'])

: "__________";

?>

</strong>

</p>

<br><br>

<div class="signature-line"></div>

<p>

<strong>

<?php echo htmlspecialchars($user['full_name']); ?>

</strong>

</p>

<p>

Candidate Signature

</p>

</div>

</section>

<!-- ==========================================
ACTION BUTTONS
========================================== -->

<div class="resume-actions">

<button
class="print-btn"
onclick="window.print();">

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

<!-- END RIGHT COLUMN -->

</div>

<!-- END RESUME BODY -->

</div>

<script src="../assets/js/template3.js"></script>

</body>

</html>