<?php
session_start();
require_once("../database/db.php");

/* ==========================================
CHECK LOGIN
========================================== */

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];

/* ==========================================
GET USER DETAILS
========================================== */

$userQuery = mysqli_query($conn, "SELECT * FROM users WHERE id='$userId'");

if (!$userQuery || mysqli_num_rows($userQuery) == 0) {
    die("User not found.");
}

$user = mysqli_fetch_assoc($userQuery);

/* ==========================================
PROFILE PHOTO
========================================== */

$profilePhoto = "../assets/images/profile/default.png";

if (!empty($user['profile_photo'])) {

    $photo = "../assets/images/profile/" . $user['profile_photo'];

    if(file_exists($photo)){
        $profilePhoto = $photo;
    }

}

if (
    !empty($user['profile_photo']) &&
    file_exists("../assets/uploads/profile/".$user['profile_photo'])
){
    $profilePhoto="../assets/uploads/profile/".$user['profile_photo'];
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Professional Profile | CareerForge

</title>

<link rel="stylesheet"
href="../assets/css/professional-profile.css">

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

<li class="active">

<i class="fa-solid fa-user-tie"></i>

<span>Professional Profile</span>

</li>

<li onclick="location.href='../jobs/job-preference.php'">

<i class="fa-solid fa-briefcase"></i>

<span>Job Preference</span>

</li>

<li onclick="location.href='../mock-exams/index.php'">

<i class="fa-solid fa-book-open"></i>

<span>Mock Exams</span>

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

<div class="page-header">

<h1>

<i class="fa-solid fa-user-tie"></i>

Professional Profile

</h1>

<p>

Complete your professional information to receive better job recommendations.

</p>

</div>

<!-- ==========================================
CANDIDATE CARD
========================================== -->

<div class="candidate-card">

<img
src="<?php echo $profilePhoto; ?>"
alt="Candidate">

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

<!-- ==========================================
FORM START
========================================== -->

<form
action="update-professional.php"
method="POST"
enctype="multipart/form-data">


<!-- ==========================================
PROFILE TYPE
========================================== -->

<div class="form-card">

    <div class="card-title">

        <i class="fa-solid fa-user-check"></i>

        <h2>Select Professional Type</h2>

    </div>

    <div class="profile-type">

        <label class="type-card">

            <input
                type="radio"
                name="professional_type"
                id="fresherRadio"
                value="Fresher"
                <?php if(($user['professional_type'] ?? '')=="Fresher") echo "checked"; ?>>

            <span>

                <i class="fa-solid fa-user-graduate"></i>

                Fresher

            </span>

        </label>

        <label class="type-card">

            <input
                type="radio"
                name="professional_type"
                id="experiencedRadio"
                value="Experienced"
                <?php if(($user['professional_type'] ?? '')=="Experienced") echo "checked"; ?>>

            <span>

                <i class="fa-solid fa-briefcase"></i>

                Experienced

            </span>

        </label>

    </div>

</div>

<!-- ==========================================
IT / NON IT CATEGORY
========================================== -->

<div
class="form-card"
id="categoryCard"
style="display:none;">

    <div class="card-title">

        <i class="fa-solid fa-layer-group"></i>

        <h2>Professional Category</h2>

    </div>

    <div class="form-grid">

        <div class="form-group">

            <label>

                Category

            </label>

            <select
                name="professional_category"
                id="professionalCategory">

                <option value="">Select Category</option>

                <option
                    value="IT"
                    <?php if(($user['professional_category'] ?? '')=="IT") echo "selected"; ?>>

                    Information Technology (IT)

                </option>

                <option
                    value="Non-IT"
                    <?php if(($user['professional_category'] ?? '')=="Non-IT") echo "selected"; ?>>

                    Non Information Technology (Non-IT)

                </option>

            </select>

        </div>

        <div class="form-group">

            <label>

                Professional ID

            </label>

            <input
                type="text"
                id="professionalId"
                name="professional_id"
                value="<?php echo htmlspecialchars($user['professional_id'] ?? ''); ?>"
                readonly>

            <small>

                Automatically generated after selecting category.

            </small>

        </div>

    </div>

</div>

<!-- ==========================================
FRESHER SECTION STARTS HERE
========================================== -->

<div
class="form-card profile-section"
id="fresherSection"
style="display:none;">

    <div class="card-title">

        <i class="fa-solid fa-user-graduate"></i>

        <h2>Fresher Profile</h2>

    </div>

    <div class="form-grid">

            <!-- Career Objective -->

        <div class="form-group full-width">

            <label>

                Career Objective

            </label>

            <textarea
                name="career_objective"
                rows="4"
                placeholder="Write your career objective..."><?php echo htmlspecialchars($user['career_objective'] ?? ''); ?></textarea>

        </div>

        <!-- Technical Skills -->

        <div class="form-group">

            <label>

                Technical Skills

            </label>

            <input
                type="text"
                name="technical_skills"
                value="<?php echo htmlspecialchars($user['technical_skills'] ?? ''); ?>"
                placeholder="Java, PHP, Python, React">

        </div>

        <!-- Soft Skills -->

        <div class="form-group">

            <label>

                Soft Skills

            </label>

            <input
                type="text"
                name="soft_skills"
                value="<?php echo htmlspecialchars($user['soft_skills'] ?? ''); ?>"
                placeholder="Communication, Leadership">

        </div>

        <!-- Primary Skills -->

        <div class="form-group">

            <label>

                Primary Skills

            </label>

            <input
                type="text"
                name="primary_skills"
                value="<?php echo htmlspecialchars($user['primary_skills'] ?? ''); ?>"
                placeholder="HTML, CSS, JavaScript">

        </div>

        <!-- Secondary Skills -->

        <div class="form-group">

            <label>

                Secondary Skills

            </label>

            <input
                type="text"
                name="secondary_skills"
                value="<?php echo htmlspecialchars($user['secondary_skills'] ?? ''); ?>"
                placeholder="Bootstrap, MySQL">

        </div>

        <!-- Projects -->

        <div class="form-group full-width">

            <label>

                Academic Projects

            </label>

            <textarea
                name="projects"
                rows="4"
                placeholder="Describe your projects"><?php echo htmlspecialchars($user['projects'] ?? ''); ?></textarea>

        </div>

        <!-- Internship -->

        <div class="form-group full-width">

            <label>

                Internship

            </label>

            <textarea
                name="internship"
                rows="3"
                placeholder="Internship Details"><?php echo htmlspecialchars($user['internship'] ?? ''); ?></textarea>

        </div>

        <!-- Certifications -->

        <div class="form-group full-width">

            <label>

                Certifications

            </label>

            <textarea
                name="certifications"
                rows="3"
                placeholder="AWS, Cisco, Java, Python"><?php echo htmlspecialchars($user['certifications'] ?? ''); ?></textarea>

        </div>

        <!-- Languages -->

        <div class="form-group">

            <label>

                Languages Known

            </label>

            <input
                type="text"
                name="languages"
                value="<?php echo htmlspecialchars($user['languages'] ?? ''); ?>"
                placeholder="English, Telugu, Hindi">

        </div>

        <!-- Ready To Relocate -->

        <div class="form-group">

            <label>

                Ready To Relocate

            </label>

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

        <!-- Resume -->

        <div class="form-group full-width">

            <label>

                Upload Resume

            </label>

            <input
                type="file"
                name="resume"
                accept=".pdf,.doc,.docx">

            <?php if(!empty($user['resume'])){ ?>

                <p class="resume-info">

                    Current Resume :

                    <a
                    href="../assets/uploads/resume/<?php echo $user['resume']; ?>"
                    target="_blank">

                        View Resume

                    </a>

                </p>

            <?php } ?>

        </div>

    </div>

</div>

<!-- ==========================================
EXPERIENCED PROFILE STARTS HERE
========================================== -->

<div
class="form-card profile-section"
id="experiencedSection"
style="display:none;">

<div class="card-title">

<i class="fa-solid fa-briefcase"></i>

<h2>

Experienced Profile

</h2>

</div>

<div class="form-grid">

    <!-- Current Company -->

    <div class="form-group">

        <label>

            Current Company

        </label>

        <input
            type="text"
            name="current_company"
            value="<?php echo htmlspecialchars($user['current_company'] ?? ''); ?>"
            placeholder="Current Company Name">

    </div>

    <!-- Designation -->

    <div class="form-group">

        <label>

            Current Designation

        </label>

        <input
            type="text"
            name="designation"
            value="<?php echo htmlspecialchars($user['designation'] ?? ''); ?>"
            placeholder="Software Engineer">

    </div>

    <!-- Total Experience -->

    <div class="form-group">

        <label>

            Total Experience

        </label>

        <input
            type="text"
            name="total_experience"
            value="<?php echo htmlspecialchars($user['total_experience'] ?? ''); ?>"
            placeholder="2 Years 6 Months">

    </div>

    <!-- Relevant Experience -->

    <div class="form-group">

        <label>

            Relevant Experience

        </label>

        <input
            type="text"
            name="relevant_experience"
            value="<?php echo htmlspecialchars($user['relevant_experience'] ?? ''); ?>"
            placeholder="2 Years">

    </div>

    <!-- Current CTC -->

    <div class="form-group">

        <label>

            Current CTC

        </label>

        <input
            type="text"
            name="current_ctc"
            value="<?php echo htmlspecialchars($user['current_ctc'] ?? ''); ?>"
            placeholder="6 LPA">

    </div>

    <!-- Expected CTC -->

    <div class="form-group">

        <label>

            Expected CTC

        </label>

        <input
            type="text"
            name="expected_ctc"
            value="<?php echo htmlspecialchars($user['expected_ctc'] ?? ''); ?>"
            placeholder="8 LPA">

    </div>

    <!-- Notice Period -->

    <div class="form-group">

        <label>

            Notice Period

        </label>

        <select name="notice_period">

            <option value="">Select</option>

            <option value="Immediate" <?php if(($user['notice_period'] ?? '')=="Immediate") echo "selected"; ?>>Immediate</option>

            <option value="15 Days" <?php if(($user['notice_period'] ?? '')=="15 Days") echo "selected"; ?>>15 Days</option>

            <option value="30 Days" <?php if(($user['notice_period'] ?? '')=="30 Days") echo "selected"; ?>>30 Days</option>

            <option value="45 Days" <?php if(($user['notice_period'] ?? '')=="45 Days") echo "selected"; ?>>45 Days</option>

            <option value="60 Days" <?php if(($user['notice_period'] ?? '')=="60 Days") echo "selected"; ?>>60 Days</option>

            <option value="90 Days" <?php if(($user['notice_period'] ?? '')=="90 Days") echo "selected"; ?>>90 Days</option>

        </select>

    </div>

    <!-- Current Location -->

    <div class="form-group">

        <label>

            Current Location

        </label>

        <input
            type="text"
            name="current_location"
            value="<?php echo htmlspecialchars($user['current_location'] ?? ''); ?>"
            placeholder="Hyderabad">

    </div>

    <!-- Technical Skills -->

    <div class="form-group full-width">

        <label>

            Technical Skills

        </label>

        <textarea
            name="technical_skills"
            rows="3"
            placeholder="PHP, Laravel, Java, React"><?php echo htmlspecialchars($user['technical_skills'] ?? ''); ?></textarea>

    </div>

    <!-- Previous Companies -->

    <div class="form-group full-width">

        <label>

            Previous Companies

        </label>

        <textarea
            name="previous_companies"
            rows="3"
            placeholder="Previous Organizations"><?php echo htmlspecialchars($user['previous_companies'] ?? ''); ?></textarea>

    </div>

    <!-- Responsibilities -->

    <div class="form-group full-width">

        <label>

            Key Responsibilities

        </label>

        <textarea
            name="responsibilities"
            rows="4"
            placeholder="Describe your responsibilities"><?php echo htmlspecialchars($user['responsibilities'] ?? ''); ?></textarea>

    </div>

    <!-- Achievements -->

    <div class="form-group full-width">

        <label>

            Achievements

        </label>

        <textarea
            name="achievements"
            rows="4"
            placeholder="Awards / Promotions / Appreciations"><?php echo htmlspecialchars($user['achievements'] ?? ''); ?></textarea>

    </div>

    <!-- Resume -->

    <div class="form-group full-width">

        <label>

            Upload Updated Resume

        </label>

        <input
            type="file"
            name="resume"
            accept=".pdf,.doc,.docx">

        <?php if(!empty($user['resume'])){ ?>

        <p class="resume-info">

            Current Resume :

            <a href="../assets/uploads/resume/<?php echo $user['resume']; ?>" target="_blank">

                View Resume

            </a>

        </p>

        <?php } ?>

    </div>

</div>

</div>

<!-- ==========================================
COMMON PROFESSIONAL DETAILS
========================================== -->

<div class="form-card">

<div class="card-title">

<i class="fa-solid fa-globe"></i>

<h2>

Common Professional Details

</h2>

</div>

<div class="form-grid">


    <!-- Preferred Job Role -->

    <div class="form-group">

        <label>

            Preferred Job Role

        </label>

        <input
            type="text"
            name="job_role"
            value="<?php echo htmlspecialchars($user['job_role'] ?? ''); ?>"
            placeholder="Software Engineer">

    </div>

    <!-- Preferred Industry -->

    <div class="form-group">

        <label>

            Preferred Industry

        </label>

        <select name="preferred_industry">

            <option value="">Select Industry</option>

            <option value="IT" <?php if(($user['preferred_industry'] ?? '')=="IT") echo "selected"; ?>>IT</option>

            <option value="Non-IT" <?php if(($user['preferred_industry'] ?? '')=="Non-IT") echo "selected"; ?>>Non-IT</option>

            <option value="Banking" <?php if(($user['preferred_industry'] ?? '')=="Banking") echo "selected"; ?>>Banking</option>

            <option value="Healthcare" <?php if(($user['preferred_industry'] ?? '')=="Healthcare") echo "selected"; ?>>Healthcare</option>

            <option value="Manufacturing" <?php if(($user['preferred_industry'] ?? '')=="Manufacturing") echo "selected"; ?>>Manufacturing</option>

        </select>

    </div>

    <!-- Employment Type -->

    <div class="form-group">

        <label>

            Employment Type

        </label>

        <select name="employment_type">

            <option value="">Select</option>

            <option value="Full Time" <?php if(($user['employment_type'] ?? '')=="Full Time") echo "selected"; ?>>Full Time</option>

            <option value="Part Time" <?php if(($user['employment_type'] ?? '')=="Part Time") echo "selected"; ?>>Part Time</option>

            <option value="Internship" <?php if(($user['employment_type'] ?? '')=="Internship") echo "selected"; ?>>Internship</option>

            <option value="Contract" <?php if(($user['employment_type'] ?? '')=="Contract") echo "selected"; ?>>Contract</option>

        </select>

    </div>

    <!-- Work Mode -->

    <div class="form-group">

        <label>

            Work Mode

        </label>

        <select name="work_mode">

            <option value="">Select</option>

            <option value="Work From Office" <?php if(($user['work_mode'] ?? '')=="Work From Office") echo "selected"; ?>>Work From Office</option>

            <option value="Hybrid" <?php if(($user['work_mode'] ?? '')=="Hybrid") echo "selected"; ?>>Hybrid</option>

            <option value="Remote" <?php if(($user['work_mode'] ?? '')=="Remote") echo "selected"; ?>>Remote</option>

        </select>

    </div>

    <!-- Preferred Location 1 -->

    <div class="form-group">

        <label>

            Preferred Location 1

        </label>

        <input
            type="text"
            name="preferred_location"
            value="<?php echo htmlspecialchars($user['preferred_location'] ?? ''); ?>"
            placeholder="Hyderabad">

    </div>

    <!-- Preferred Location 2 -->

    <div class="form-group">

        <label>

            Preferred Location 2

        </label>

        <input
            type="text"
            name="preferred_location2"
            value="<?php echo htmlspecialchars($user['preferred_location2'] ?? ''); ?>"
            placeholder="Bangalore">

    </div>

    <!-- Preferred Location 3 -->

    <div class="form-group">

        <label>

            Preferred Location 3

        </label>

        <input
            type="text"
            name="preferred_location3"
            value="<?php echo htmlspecialchars($user['preferred_location3'] ?? ''); ?>"
            placeholder="Chennai">

    </div>

    <!-- Joining Date -->

    <div class="form-group">

        <label>

            Available Joining Date

        </label>

        <input
            type="date"
            name="joining_date"
            value="<?php echo htmlspecialchars($user['joining_date'] ?? ''); ?>">

    </div>

</div>

</div>

<!-- ==========================================
SAVE BUTTONS
========================================== -->

<div class="button-group">

    <button
        type="submit"
        class="save-btn">

        <i class="fa-solid fa-floppy-disk"></i>

        Save Professional Profile

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

<script src="../assets/js/professional-profile.js"></script>

</body>

</html>