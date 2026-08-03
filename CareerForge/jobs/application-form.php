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

$userId = $_SESSION['user_id'];
$jobId = (int)$_GET['id'];

/* ===============================
GET USER DETAILS
=============================== */

$userQuery = mysqli_query($conn,
"SELECT * FROM users WHERE id='$userId'");

$user = mysqli_fetch_assoc($userQuery);

/* ===============================
GET JOB DETAILS
=============================== */

$jobQuery = mysqli_query($conn,
"SELECT * FROM jobs WHERE id='$jobId'");

if(mysqli_num_rows($jobQuery)==0){

die("Job not found.");

}

$job=mysqli_fetch_assoc($jobQuery);

$logo=!empty($job['company_logo'])
?
"../assets/images/companies/".$job['company_logo']
:
"../assets/images/companies/default-company.png";

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Apply Job |
CareerForge

</title>

<link
rel="stylesheet"
href="../assets/css/application-form.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="container">

<div class="page-header">

<h1>

<i class="fa-solid fa-paper-plane"></i>

Job Application

</h1>

<p>

Complete your application before submitting.

</p>

</div>

<!-- =======================================
JOB CARD
======================================= -->

<div class="job-card">

<img src="<?php echo $logo; ?>">

<div>

<h2>

<?php echo htmlspecialchars($job['job_title']); ?>

</h2>

<h3>

<?php echo htmlspecialchars($job['company_name']); ?>

</h3>

<p>

<i class="fa-solid fa-location-dot"></i>

<?php echo htmlspecialchars($job['location']); ?>

</p>

</div>

</div>

<form
action="submit-application.php"
method="POST"
enctype="multipart/form-data">

<input
type="hidden"
name="job_id"
value="<?php echo $jobId; ?>">

<!-- ==========================================
PERSONAL INFORMATION
========================================== -->

<div class="form-card">

    <div class="card-title">

        <i class="fa-solid fa-user"></i>

        <h2>Personal Information</h2>

    </div>

    <div class="form-grid">

        <div class="form-group">

            <label>Full Name</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['full_name']); ?>"
                readonly>

        </div>

        <div class="form-group">

            <label>Email Address</label>

            <input
                type="email"
                value="<?php echo htmlspecialchars($user['email']); ?>"
                readonly>

        </div>

        <div class="form-group">

            <label>Mobile Number</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['mobile']); ?>"
                readonly>

        </div>

        <div class="form-group">

            <label>Date of Birth</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['dob']); ?>"
                readonly>

        </div>

        <div class="form-group">

            <label>Gender</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['gender']); ?>"
                readonly>

        </div>

        <div class="form-group">

            <label>Nationality</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['nationality']); ?>"
                readonly>

        </div>

        <div class="form-group full-width">

            <label>Current Address</label>

            <textarea
                rows="3"
                readonly><?php echo htmlspecialchars($user['address']); ?></textarea>

        </div>

    </div>

</div>

<!-- ==========================================
EDUCATION DETAILS
========================================== -->

<div class="form-card">

    <div class="card-title">

        <i class="fa-solid fa-graduation-cap"></i>

        <h2>Education Details</h2>

    </div>

    <div class="form-grid">

        <div class="form-group">

            <label>Highest Qualification</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['degree']); ?>"
                readonly>

        </div>

        <div class="form-group">

            <label>Course / Branch</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['course']); ?>"
                readonly>

        </div>

        <div class="form-group">

            <label>Career Choice</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['career_choice']); ?>"
                readonly>

        </div>

        <div class="form-group">

            <label>Professional Type</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['professional_type']); ?>"
                readonly>

        </div>

    </div>

</div>


<!-- ==========================================
PROFESSIONAL DETAILS
========================================== -->

<div class="form-card">

    <div class="card-title">

        <i class="fa-solid fa-user-tie"></i>

        <h2>Professional Details</h2>

    </div>

    <div class="form-grid">

        <div class="form-group">

            <label>Preferred Job Role</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['job_role']); ?>"
                readonly>

        </div>

        <div class="form-group">

            <label>Technical Skills</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['technical_skills']); ?>"
                readonly>

        </div>

        <div class="form-group">

            <label>Experience</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['professional_type']); ?>"
                readonly>

        </div>

<?php if(($user['professional_type'] ?? '')=="Experienced"){ ?>

        <div class="form-group">

            <label>Current Company</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['current_company']); ?>"
                readonly>

        </div>

        <div class="form-group">

            <label>Total Experience</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['total_experience']); ?>"
                readonly>

        </div>

        <div class="form-group">

            <label>Current CTC</label>

            <input
                type="text"
                value="<?php echo htmlspecialchars($user['current_ctc']); ?>"
                readonly>

        </div>

<?php } ?>

    </div>

</div>

<!-- ==========================================
APPLICATION DETAILS
========================================== -->

<div class="form-card">

    <div class="card-title">

        <i class="fa-solid fa-file-signature"></i>

        <h2>Application Details</h2>

    </div>

    <div class="form-grid">

        <div class="form-group full-width">

            <label>Cover Letter</label>

            <textarea
                name="cover_letter"
                rows="6"
                placeholder="Write why you are suitable for this position..."
                required></textarea>

        </div>

        <div class="form-group">

            <label>Expected CTC</label>

            <input
                type="text"
                name="expected_ctc"
                value="<?php echo htmlspecialchars($user['expected_ctc']); ?>">

        </div>

        <div class="form-group">

            <label>Available to Join</label>

            <select name="joining_time" required>

                <option value="">Select</option>

                <option value="Immediate">Immediate</option>

                <option value="15 Days">15 Days</option>

                <option value="30 Days">30 Days</option>

                <option value="45 Days">45 Days</option>

                <option value="60 Days">60 Days</option>

                <option value="90 Days">90 Days</option>

            </select>

        </div>

        <div class="form-group">

            <label>Willing to Relocate</label>

            <select name="relocate">

                <option value="Yes">Yes</option>

                <option value="No">No</option>

            </select>

        </div>

        <div class="form-group full-width">

            <label>Upload Resume</label>

            <input
                type="file"
                name="resume"
                accept=".pdf,.doc,.docx">

        </div>

    </div>

</div>

<!-- ==========================================
DECLARATION
========================================== -->

<div class="form-card">

    <label class="checkbox">

        <input
            type="checkbox"
            required>

        I hereby declare that all the information provided by me is true and correct to the best of my knowledge.

    </label>

</div>

<!-- ==========================================
BUTTONS
========================================== -->

<div class="button-group">

    <button
        type="submit"
        class="submit-btn">

        <i class="fa-solid fa-paper-plane"></i>

        Submit Application

    </button>

    <a
        href="job-details.php?id=<?php echo $jobId; ?>"
        class="cancel-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Back

    </a>

</div>

</form>

</div>

<script src="../assets/js/application-form.js"></script>

</body>

</html>