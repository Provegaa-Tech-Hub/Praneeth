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

"SELECT *
FROM users
WHERE id='$userId'"

);

if(mysqli_num_rows($userQuery)==0){

die("Candidate not found.");

}

$user=mysqli_fetch_assoc($userQuery);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Upload Resume | CareerForge

</title>

<link
rel="stylesheet"
href="../assets/css/upload-resume.css">

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

<div class="left-header">

<h1>

<i class="fa-solid fa-file-arrow-up"></i>

Upload Resume

</h1>

<p>

Upload your latest resume for job applications.

</p>

</div>

<div class="right-header">

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

echo !empty($user['job_role'])

? htmlspecialchars($user['job_role'])

: "Candidate";

?>

</p>

</div>

</div>

</header>

<!-- ==========================================
UPLOAD CARD
========================================== -->

<div class="upload-card">

<h2>

Upload Your Resume

</h2>

<p>

Supported Formats:

<strong>

PDF, DOC, DOCX

</strong>

(Maximum 5 MB)

</p>

<form

action="save-resume.php"

method="POST"

enctype="multipart/form-data"

id="resumeForm">

<div class="upload-box">

<i class="fa-solid fa-cloud-arrow-up"></i>

<h3>

Choose Resume File

</h3>

<input

type="file"

name="resume"

id="resume"

accept=".pdf,.doc,.docx"

required>

<label for="resume">

Select Resume

</label>

<p id="fileName">

No file selected

</p>

</div>
<!-- ==========================================
UPLOAD BUTTON
========================================== -->

<div class="button-group">

<button
type="submit"
class="upload-btn">

<i class="fa-solid fa-upload"></i>

Upload Resume

</button>

<a
href="../dashboard/dashboard.php"
class="dashboard-btn">

<i class="fa-solid fa-house"></i>

Back to Dashboard

</a>

</div>

</form>

</div>

<!-- ==========================================
CURRENT RESUME
========================================== -->

<div class="resume-card">

<h2>

Current Resume

</h2>

<?php

if(!empty($user['resume'])){

?>

<div class="resume-details">

<div class="resume-icon">

<i class="fa-solid fa-file-pdf"></i>

</div>

<div class="resume-info">

<h3>

<?php echo htmlspecialchars($user['resume']); ?>

</h3>

<p>

Resume uploaded successfully.

</p>

</div>

</div>

<div class="resume-actions">

<a

href="../assets/uploads/resume/<?php echo urlencode($user['resume']); ?>"

target="_blank"

class="view-btn">

<i class="fa-solid fa-eye"></i>

View Resume

</a>

<a
href="../assets/uploads/resume/<?php echo urlencode($user['resume']); ?>"

download

class="download-btn">

<i class="fa-solid fa-download"></i>

Download

</a>

<a

href="delete-resume.php"

class="delete-btn"

onclick="return confirm('Are you sure you want to delete your resume?');">

<i class="fa-solid fa-trash"></i>

Delete

</a>

</div>

<?php

}else{

?>

<div class="no-resume">

<i class="fa-solid fa-file-circle-xmark"></i>

<h3>

No Resume Uploaded

</h3>

<p>

Upload your latest resume to apply for jobs.

</p>

</div>

<?php

}

?>

</div>

<!-- ==========================================
UPLOAD GUIDELINES
========================================== -->

<div class="guidelines">

<h2>

Resume Guidelines

</h2>

<ul>

<li>Upload only PDF, DOC or DOCX files.</li>

<li>Maximum file size: 5 MB.</li>

<li>Keep your resume updated.</li>

<li>Include your latest education and experience.</li>

<li>Make sure your contact details are correct.</li>

</ul>

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

<script src="../assets/js/upload-resume.js"></script>

</body>

</html>