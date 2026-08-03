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
    "SELECT * FROM users WHERE id='$userId' LIMIT 1"
);

$user = mysqli_fetch_assoc($userQuery);

if(!$user){
    die("User not found.");
}

/* ==========================================
PROFILE PHOTO
========================================== */

$profilePhoto = !empty($user['profile_photo'])
    ? "../assets/images/profile/" . htmlspecialchars($user['profile_photo'])
    : "../assets/images/profile/default.png";

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>CareerForge | Job Preference</title>

<link rel="stylesheet"
href="../assets/css/job-preference.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<!-- ==========================================
SIDEBAR
========================================== -->

<aside class="sidebar">

<div class="logo">

<i class="fa-solid fa-graduation-cap"></i>

<h2>CareerForge</h2>

</div>

<ul>

<li onclick="location.href='../dashboard/dashboard.php'">

<i class="fa-solid fa-house"></i>

<span>Dashboard</span>

</li>

<li onclick="location.href='../profile/profile.php'">

<i class="fa-solid fa-user"></i>

<span>My Profile</span>

</li>

<li onclick="location.href='../education/education.php'">

<i class="fa-solid fa-school"></i>

<span>Education</span>

</li>

<li onclick="location.href='../professional/professional-profile.php'">

<i class="fa-solid fa-user-tie"></i>

<span>Professional Profile</span>

</li>

<li class="active">

<i class="fa-solid fa-briefcase"></i>

<span>Job Preference</span>

</li>

<li onclick="location.href='../logout.php'">

<i class="fa-solid fa-right-from-bracket"></i>

<span>Logout</span>

</li>

</ul>

</aside>

<!-- ==========================================
MAIN CONTENT
========================================== -->

<div class="main-content">

<?php if(isset($_SESSION['success_message'])){ ?>

<div class="success-message">

<i class="fa-solid fa-circle-check"></i>

<?php
echo $_SESSION['success_message'];
unset($_SESSION['success_message']);
?>

</div>

<?php } ?>

<?php if(isset($_SESSION['error_message'])){ ?>

<div class="error-message">

<i class="fa-solid fa-circle-xmark"></i>

<?php
echo $_SESSION['error_message'];
unset($_SESSION['error_message']);
?>

</div>

<?php } ?>

<div class="page-header">

<h1>

<i class="fa-solid fa-briefcase"></i>

Job Preference

</h1>

<p>

Tell recruiters what kind of job you are looking for.

</p>

</div>

<!-- ==========================================
CANDIDATE CARD
========================================== -->

<div class="candidate-card">

<img
src="<?php echo $profilePhoto; ?>"
alt="Profile">

<div>

<h2>

<?php echo htmlspecialchars($user['full_name']); ?>

</h2>

<p>

<?php echo htmlspecialchars($user['email']); ?>

</p>

<p>

<?php echo htmlspecialchars($user['mobile']); ?>

</p>

</div>

</div>

<form
action="update-job-preference.php"
method="POST"
enctype="multipart/form-data">

<!-- ==========================================
CAREER PREFERENCE
========================================== -->

<div class="form-card">

    <div class="card-title">

        <i class="fa-solid fa-briefcase"></i>

        <h2>Career Preference</h2>

    </div>

    <div class="form-grid">

        <div class="form-group">

            <label>Career Choice</label>

            <input
                type="text"
                name="career_choice"
                placeholder="Software Development, Testing, UI/UX"
                value="<?php echo htmlspecialchars($user['career_choice'] ?? ''); ?>">

        </div>

        <div class="form-group">

            <label>Preferred Job Role</label>

            <input
                type="text"
                name="job_role"
                placeholder="Software Engineer"
                value="<?php echo htmlspecialchars($user['job_role'] ?? ''); ?>">

        </div>

        <div class="form-group">

            <label>Preferred Industry</label>

            <input
                type="text"
                name="preferred_industry"
                placeholder="IT Services"
                value="<?php echo htmlspecialchars($user['preferred_industry'] ?? ''); ?>">

        </div>

        <div class="form-group">

            <label>Employment Type</label>

            <select name="employment_type">

                <option value="">Select</option>

                <option value="Full Time"
                <?php if(($user['employment_type'] ?? '')=="Full Time") echo "selected"; ?>>

                Full Time

                </option>

                <option value="Part Time"
                <?php if(($user['employment_type'] ?? '')=="Part Time") echo "selected"; ?>>

                Part Time

                </option>

                <option value="Internship"
                <?php if(($user['employment_type'] ?? '')=="Internship") echo "selected"; ?>>

                Internship

                </option>

                <option value="Contract"
                <?php if(($user['employment_type'] ?? '')=="Contract") echo "selected"; ?>>

                Contract

                </option>

            </select>

        </div>

        <div class="form-group">

            <label>Preferred Work Mode</label>

            <select name="work_mode">

                <option value="">Select</option>

                <option value="Work From Office"
                <?php if(($user['work_mode'] ?? '')=="Work From Office") echo "selected"; ?>>

                Work From Office

                </option>

                <option value="Hybrid"
                <?php if(($user['work_mode'] ?? '')=="Hybrid") echo "selected"; ?>>

                Hybrid

                </option>

                <option value="Remote"
                <?php if(($user['work_mode'] ?? '')=="Remote") echo "selected"; ?>>

                Remote

                </option>

            </select>

        </div>

    </div>

</div>

<!-- ==========================================
EXPERIENCE TYPE
========================================== -->

<div class="form-card">

    <div class="card-title">

        <i class="fa-solid fa-user-clock"></i>

        <h2>Experience</h2>

    </div>

    <div class="profile-type">

        <label>

            <input
                type="radio"
                name="experience_type"
                value="Fresher"
                <?php if(($user['professional_type'] ?? '')=="Fresher") echo "checked"; ?>>

            Fresher

        </label>

        <label>

            <input
                type="radio"
                name="experience_type"
                value="Experienced"
                <?php if(($user['professional_type'] ?? '')=="Experienced") echo "checked"; ?>>

            Experienced

        </label>

    </div>

</div>

<!-- ==========================================
EXPERIENCE DETAILS
========================================== -->

<div class="form-card" id="experienceSection">

    <div class="card-title">

        <i class="fa-solid fa-building"></i>

        <h2>Experience Details</h2>

    </div>

    <div class="form-grid">

        <div class="form-group">

            <label>Total Experience</label>

            <input
                type="text"
                name="total_experience"
                placeholder="2 Years"
                value="<?php echo htmlspecialchars($user['total_experience'] ?? ''); ?>">

        </div>

        <div class="form-group">

            <label>Relevant Experience</label>

            <input
                type="text"
                name="relevant_experience"
                placeholder="1.5 Years"
                value="<?php echo htmlspecialchars($user['relevant_experience'] ?? ''); ?>">

        </div>

        <div class="form-group">

            <label>Current CTC</label>

            <input
                type="text"
                name="current_ctc"
                placeholder="5 LPA"
                value="<?php echo htmlspecialchars($user['current_ctc'] ?? ''); ?>">

        </div>

        <div class="form-group">

            <label>Expected CTC</label>

            <input
                type="text"
                name="expected_ctc"
                placeholder="8 LPA"
                value="<?php echo htmlspecialchars($user['expected_ctc'] ?? ''); ?>">

        </div>

    </div>

</div>

<!-- ==========================================
PREFERRED JOB LOCATIONS
========================================== -->

<div class="form-card">

    <div class="card-title">

        <i class="fa-solid fa-location-dot"></i>

        <h2>Preferred Job Locations</h2>

    </div>

    <div class="form-grid">

        <div class="form-group">

            <label>Preferred Location 1</label>

            <input
                type="text"
                name="preferred_location"
                placeholder="Hyderabad"
                value="<?php echo htmlspecialchars($user['preferred_location'] ?? ''); ?>">

        </div>

        <div class="form-group">

            <label>Preferred Location 2</label>

            <input
                type="text"
                name="preferred_location2"
                placeholder="Bangalore"
                value="<?php echo htmlspecialchars($user['preferred_location2'] ?? ''); ?>">

        </div>

        <div class="form-group">

            <label>Preferred Location 3</label>

            <input
                type="text"
                name="preferred_location3"
                placeholder="Chennai"
                value="<?php echo htmlspecialchars($user['preferred_location3'] ?? ''); ?>">

        </div>

        <div class="form-group">

            <label>Ready to Relocate</label>

            <select name="relocate">

                <option value="">Select</option>

                <option value="Yes"
                <?php if(($user['relocate'] ?? '')=="Yes") echo "selected"; ?>>

                    Yes

                </option>

                <option value="No"
                <?php if(($user['relocate'] ?? '')=="No") echo "selected"; ?>>

                    No

                </option>

            </select>

        </div>

    </div>

</div>

<!-- ==========================================
AVAILABILITY
========================================== -->

<div class="form-card">

    <div class="card-title">

        <i class="fa-solid fa-calendar-check"></i>

        <h2>Availability</h2>

    </div>

    <div class="form-grid">

        <div class="form-group">

            <label>Notice Period</label>

            <select name="notice_period">

                <option value="">Select</option>

                <option value="Immediate"
                <?php if(($user['notice_period'] ?? '')=="Immediate") echo "selected"; ?>>

                    Immediate

                </option>

                <option value="15 Days"
                <?php if(($user['notice_period'] ?? '')=="15 Days") echo "selected"; ?>>

                    15 Days

                </option>

                <option value="30 Days"
                <?php if(($user['notice_period'] ?? '')=="30 Days") echo "selected"; ?>>

                    30 Days

                </option>

                <option value="45 Days"
                <?php if(($user['notice_period'] ?? '')=="45 Days") echo "selected"; ?>>

                    45 Days

                </option>

                <option value="60 Days"
                <?php if(($user['notice_period'] ?? '')=="60 Days") echo "selected"; ?>>

                    60 Days

                </option>

                <option value="90 Days"
                <?php if(($user['notice_period'] ?? '')=="90 Days") echo "selected"; ?>>

                    90 Days

                </option>

            </select>

        </div>

        <div class="form-group">

            <label>Joining Date</label>

            <input
                type="date"
                name="joining_date"
                value="<?php echo htmlspecialchars($user['joining_date'] ?? ''); ?>">

        </div>

    </div>

</div>


<!-- ==========================================
SKILLS
========================================== -->

<div class="form-card">

    <div class="card-title">

        <i class="fa-solid fa-code"></i>

        <h2>Skills</h2>

    </div>

    <div class="form-grid">

        <div class="form-group full-width">

            <label>Primary Skills</label>

            <textarea
                name="primary_skills"
                rows="3"
                placeholder="Java, PHP, Python"><?php echo htmlspecialchars($user['primary_skills'] ?? ''); ?></textarea>

        </div>

        <div class="form-group full-width">

            <label>Secondary Skills</label>

            <textarea
                name="secondary_skills"
                rows="3"
                placeholder="HTML, CSS, JavaScript"><?php echo htmlspecialchars($user['secondary_skills'] ?? ''); ?></textarea>

        </div>

    </div>

</div>

<!-- ==========================================
UPLOAD RESUME
========================================== -->

<div class="form-card">

    <div class="card-title">

        <i class="fa-solid fa-file-arrow-up"></i>

        <h2>Resume</h2>

    </div>

    <div class="form-grid">

        <div class="form-group full-width">

            <label>Upload Resume</label>

            <input
                type="file"
                name="resume"
                accept=".pdf,.doc,.docx">

        </div>

        <?php if(!empty($user['resume'])) { ?>

        <div class="form-group full-width">

            <label>Current Resume</label>

            <a
                href="../assets/uploads/resume/<?php echo htmlspecialchars($user['resume']); ?>"
                target="_blank"
                class="resume-link">

                <i class="fa-solid fa-file-pdf"></i>

                View Uploaded Resume

            </a>

        </div>

        <?php } ?>

    </div>

</div>

<!-- ==========================================
BUTTONS
========================================== -->

<div class="button-group">

    <button
        type="submit"
        class="save-btn">

        <i class="fa-solid fa-floppy-disk"></i>

        Save Job Preference

    </button>

    <button
        type="reset"
        class="reset-btn">

        <i class="fa-solid fa-rotate-left"></i>

        Reset

    </button>

</div>

</form>

</div>

<script src="../assets/js/job-preference.js"></script>

</body>

</html>