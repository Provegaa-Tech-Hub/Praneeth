<?php
session_start();
require_once("../database/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: available-jobs.php");
    exit();
}

$jobId = (int)$_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM jobs WHERE id='$jobId'");

if (mysqli_num_rows($query) == 0) {
    die("Job not found.");
}

$job = mysqli_fetch_assoc($query);

$logo = !empty($job['company_logo'])
    ? "../assets/images/companies/" . $job['company_logo']
    : "../assets/images/companies/default-company.png";
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo htmlspecialchars($job['job_title']); ?> | CareerForge</title>

<link rel="stylesheet"
href="../assets/css/job-details.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="container">

    <div class="job-header">

        <img src="<?php echo $logo; ?>" alt="Company Logo">

        <div>

            <h1><?php echo htmlspecialchars($job['job_title']); ?></h1>

            <h3><?php echo htmlspecialchars($job['company_name']); ?></h3>

        </div>

    </div>

    <!-- ==========================================
JOB INFORMATION
========================================== -->

<div class="job-info-grid">

    <div class="info-box">

        <i class="fa-solid fa-layer-group"></i>

        <h4>Category</h4>

        <p><?php echo htmlspecialchars($job['job_category']); ?></p>

    </div>

    <div class="info-box">

        <i class="fa-solid fa-briefcase"></i>

        <h4>Employment Type</h4>

        <p><?php echo htmlspecialchars($job['employment_type']); ?></p>

    </div>

    <div class="info-box">

        <i class="fa-solid fa-user-clock"></i>

        <h4>Experience</h4>

        <p><?php echo htmlspecialchars($job['experience_required']); ?></p>

    </div>

    <div class="info-box">

        <i class="fa-solid fa-money-bill-wave"></i>

        <h4>Salary</h4>

        <p><?php echo htmlspecialchars($job['salary']); ?></p>

    </div>

    <div class="info-box">

        <i class="fa-solid fa-location-dot"></i>

        <h4>Location</h4>

        <p><?php echo htmlspecialchars($job['location']); ?></p>

    </div>

    <div class="info-box">

        <i class="fa-solid fa-users"></i>

        <h4>Vacancies</h4>

        <p><?php echo htmlspecialchars($job['vacancies']); ?></p>

    </div>

    <div class="info-box">

        <i class="fa-solid fa-graduation-cap"></i>

        <h4>Qualification</h4>

        <p><?php echo htmlspecialchars($job['education_required']); ?></p>

    </div>

    <div class="info-box">

        <i class="fa-solid fa-calendar-days"></i>

        <h4>Last Date</h4>

        <p><?php echo date("d M Y", strtotime($job['last_date'])); ?></p>

    </div>

</div>

<!-- ==========================================
SKILLS
========================================== -->

<div class="content-card">

    <h2>

        <i class="fa-solid fa-code"></i>

        Required Skills

    </h2>

    <p>

        <?php echo nl2br(htmlspecialchars($job['skills_required'])); ?>

    </p>

</div>

<!-- ==========================================
JOB DESCRIPTION
========================================== -->

<div class="content-card">

    <h2>

        <i class="fa-solid fa-file-lines"></i>

        Job Description

    </h2>

    <p>

        <?php echo nl2br(htmlspecialchars($job['job_description'])); ?>

    </p>

</div>

<!-- ==========================================
RESPONSIBILITIES
========================================== -->

<div class="content-card">

    <h2>

        <i class="fa-solid fa-list-check"></i>

        Responsibilities

    </h2>

    <p>

        <?php echo nl2br(htmlspecialchars($job['responsibilities'])); ?>

    </p>

</div>

<!-- ==========================================
BENEFITS
========================================== -->

<div class="content-card">

    <h2>

        <i class="fa-solid fa-gift"></i>

        Benefits

    </h2>

    <p>

        <?php echo nl2br(htmlspecialchars($job['benefits'])); ?>

    </p>

</div>

<!-- ==========================================
ACTION BUTTONS
========================================== -->

<div class="action-buttons">

    <a href="application-form.php?id=<?php echo $job['id']; ?>"
       class="apply-btn">

        <i class="fa-solid fa-paper-plane"></i>

        Apply Now

    </a>

    <a href="available-jobs.php"
       class="back-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Back to Available Jobs

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

<script src="../assets/js/job-details.js"></script>

</body>

</html>