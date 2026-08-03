<?php
session_start();
require_once("../database/db.php");

// Check Login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];


// Get Candidate Details
$sql = mysqli_query($conn, "SELECT * FROM users WHERE id='$userId'");
$user = mysqli_fetch_assoc($sql);

// Variables
$fullName = $user['full_name'] ?? "Candidate";
$email = $user['email'] ?? "";
$mobile = $user['mobile'] ?? "";
$degree = $user['degree'] ?? "-";
$degree = "Not Updated";

$eduQuery = mysqli_query($conn,"
SELECT degree, branch
FROM candidate_education
WHERE user_id='$userId'
LIMIT 1
");

if($eduQuery && mysqli_num_rows($eduQuery)>0){

    $edu = mysqli_fetch_assoc($eduQuery);

    $degree = $edu['degree'];

    if(!empty($edu['branch'])){
        $degree .= " - ".$edu['branch'];
    }
}
$careerChoice = $user['career_choice'] ?? "-";
$location = $user['preferred_location'] ?? "-";

// =============================
// PROFILE COMPLETION
// =============================

$profileFields = [

    $user['full_name'] ?? '',
    $user['email'] ?? '',
    $user['mobile'] ?? '',
    $user['dob'] ?? '',
    $user['gender'] ?? '',
    $user['profile_photo'] ?? '',
    $user['degree'] ?? '',
    $user['course'] ?? '',
    $user['job_role'] ?? '',
    $user['resume'] ?? ''

];


$completedFields = 0;


foreach($profileFields as $field){

    if(!empty($field)){

        $completedFields++;

    }

}


$profilePercentage = round(
    ($completedFields / count($profileFields)) * 100
);
// =============================
// PROFILE PHOTO
// =============================

$profilePhoto = "../assets/images/profile/default.png";


if (!empty($user['profile_photo'])) {


    $photoPath = "../assets/images/profile/" . $user['profile_photo'];


    if (file_exists($photoPath)) {


        $profilePhoto = $photoPath;


    }


}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>CareerForge | Candidate Dashboard</title>

<link rel="stylesheet"
href="../assets/css/dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<!-- ===========================
     SIDEBAR
=========================== -->

<aside class="sidebar">

    <div class="logo">

        <i class="fa-solid fa-graduation-cap"></i>

        <h2>CareerForge</h2>

    </div>

    <ul>

        <li class="active"
            onclick="location.href='dashboard.php'">

            <i class="fa-solid fa-house"></i>

            <span>Dashboard</span>

        </li>

        <li
        onclick="location.href='../profile/profile.php'">

            <i class="fa-solid fa-user"></i>

            <span>My Profile</span>

        </li>

        <li
        onclick="location.href='../education/education.php'">

            <i class="fa-solid fa-school"></i>

            <span>Education</span>

        </li>

        <li
        onclick="location.href='../professional/professional-profile.php'">

            <i class="fa-solid fa-user-tie"></i>

            <span>Professional Profile</span>

        </li>

        <li
        onclick="location.href='../jobs/job-preference.php'">

            <i class="fa-solid fa-location-dot"></i>

            <span>Job Preference</span>

        </li>

        <li
        onclick="location.href='../mock-exams/index.php'">

            <i class="fa-solid fa-clipboard-question"></i>

            <span>Mock Exams</span>

        </li>

        <li
        onclick="location.href='../jobs/available-jobs.php'">

            <i class="fa-solid fa-briefcase"></i>

            <span>Available Jobs</span>

        </li>

        <li onclick="location.href='../jobs/applications.php'">

    <i class="fa-solid fa-file-lines"></i>

    <span>My Applications</span>

</li>


        <li
        onclick="location.href='../upload-resume/upload-resume.php'">

            <i class="fa-solid fa-file-arrow-up"></i>

            <span>Upload Resume</span>

        </li>
                <li
        onclick="location.href='../resume/templates.php'">

            <i class="fa-solid fa-print"></i>

            <span>Print RESUME</span>

        </li>

        <li
        onclick="location.href='../settings/settings.php'">

            <i class="fa-solid fa-gear"></i>

            <span>Settings</span>

        </li>

        <li
        onclick="window.location='../logout.php'">

            <i class="fa-solid fa-right-from-bracket"></i>

            <span>Logout</span>

        </li>

    </ul>

</aside>

<!-- ===========================
     MAIN CONTENT
=========================== -->

<main class="main-content">

<!-- ===========================
     TOP HEADER
=========================== -->

<section class="top-banner">

    <div class="welcome">

    <h1>

        <span id="greeting">Good Morning</span>

        <span class="candidate-name">

            <?php echo htmlspecialchars($fullName); ?>

        </span>

        👋

    </h1>

    <p id="currentDate"></p>

    <p id="currentTime"></p>

    <p class="welcome-text">

        Welcome back to CareerForge.

        Manage your profile, education,
        professional details,
        mock exams and job applications
        from one place.

    </p>

</div>
<div class="candidate-profile">

    <div class="profile-image-box">

        <img
            id="candidateImage"
            src="<?php echo $profilePhoto; ?>"
            alt="Candidate">

       <label for="dashboardPhoto" class="camera-icon">
    <i class="fa-solid fa-camera"></i>
</label>

<form
action="../profile/update-photo.php"
method="POST"
enctype="multipart/form-data">


<input
type="file"
id="dashboardPhoto"
name="profile_image"
accept="image/*"
hidden>


<label for="dashboardPhoto" class="camera-icon">

<i class="fa-solid fa-camera"></i>

</label>


</form>
    <h3 class="profile-name">
        <?php echo htmlspecialchars($fullName); ?>
    </h3>

    <p class="registration-title">
        Registration ID
    </p>

    <p class="registration-id">
        <strong><?php echo htmlspecialchars($user['registration_id']); ?></strong>
    </p>

</div>
</section>

<!-- ===========================
     DASHBOARD CARDS
=========================== -->

<section class="dashboard-cards">

    <!-- Profile Completion -->

    <div class="dashboard-card">

        <div class="card-icon blue">

            <i class="fa-solid fa-circle-check"></i>

        </div>

        <div class="card-details">

            <span>Profile Completion</span>

            <h2 
id="profileCompletion"
data-value="<?php echo $profilePercentage; ?>">

<?php echo $profilePercentage; ?>%

</h2>

        </div>

    </div>

    <!-- Highest Qualification -->

    <div class="dashboard-card">

        <div class="card-icon green">

            <i class="fa-solid fa-user-graduate"></i>

        </div>

        <div class="card-details">

            <span>Highest Qualification</span>

            <h2>

                <?php echo htmlspecialchars($degree); ?>

            </h2>

        </div>

    </div>
    

    <!-- Career Choice -->

    <div class="dashboard-card">

        <div class="card-icon orange">

            <i class="fa-solid fa-briefcase"></i>

        </div>

        <div class="card-details">

            <span>Career Choice</span>

            <h2>

                <?php echo htmlspecialchars($careerChoice); ?>

            </h2>

        </div>

    </div>

    <!-- Present Location -->

    <div class="dashboard-card">

        <div class="card-icon red">

            <i class="fa-solid fa-location-dot"></i>

        </div>

        <div class="card-details">

            <span>Present Location</span>

            <h2>

                <?php echo htmlspecialchars($location); ?>

            </h2>

        </div>

    </div>

        <!-- Professional Profile -->

    <div class="dashboard-card">

        <div class="card-icon purple">

            <i class="fa-solid fa-user-tie"></i>

        </div>

        <div class="card-details">

            <span>Professional Profile</span>

            <h2>

               <?php

if($user['professional_type']=="Fresher"){

    echo "🎓 Fresher";

}elseif($user['professional_type']=="Experienced"){

    echo "💼 Experienced";

}else{

    echo "Not Selected";

}

?>

            </h2>

        </div>

    </div>

    <!-- Preferred Job Role -->

    <div class="dashboard-card">

        <div class="card-icon blue">

            <i class="fa-solid fa-laptop-code"></i>

        </div>

        <div class="card-details">

            <span>Preferred Job Role</span>

            <h2>

                <?php

echo !empty($user['job_role'])

? htmlspecialchars($user['job_role'])

: "Not Updated";

?>

            </h2>

        </div>

    </div>

</section>

<!-- ===========================
     CANDIDATE SUMMARY
=========================== -->

<section class="summary-section">

    <div class="summary-card">

        <div class="section-title">

            <i class="fa-solid fa-id-card"></i>

            <h2>Candidate Summary</h2>

        </div>

        <table class="summary-table">

            <!-- Profile Photo -->

            <tr>

                <th>Profile Photo</th>

                <td colspan="3">

                    <img

                    src="<?php echo $profilePhoto; ?>"

                    class="summary-photo"

                    alt="Profile">

                </td>

            </tr>

            <!-- Basic Details -->

            <tr>

                <th>Full Name</th>

                <td>

                    <?php echo htmlspecialchars($fullName); ?>

                </td>

                <th>Email</th>

                <td>

                    <?php echo htmlspecialchars($email); ?>

                </td>

            </tr>

            <tr>

                <th>Mobile</th>

                <td>

                    <?php echo htmlspecialchars($mobile); ?>

                </td>

                <th>Date of Birth</th>

                <td>

                    <?php
                    echo !empty($user['dob'])
                    ? htmlspecialchars($user['dob'])
                    : "-";
                    ?>

                </td>

            </tr>

            <tr>

                <th>Gender</th>

                <td>

                    <?php
                    echo !empty($user['gender'])
                    ? htmlspecialchars($user['gender'])
                    : "-";
                    ?>

                </td>

                <th>Highest Qualification</th>

                <td>

                    <?php echo htmlspecialchars($degree); ?>

                    

                </td>

            </tr>

            <tr>
                

                <th>Course</th>

                <td>

                    <?php
                    echo !empty($user['course'])
                    ? htmlspecialchars($user['course'])
                    : "-";
                    ?>

                </td>

                <th>Professional Type</th>

                <td>

                    <?php
                    echo !empty($user['professional_type'])
                    ? htmlspecialchars($user['professional_type'])
                    : "-";
                    ?>

                </td>

                <tr>

<th>Technical Skills</th>

<td>

<?php

echo !empty($user['technical_skills'])

? htmlspecialchars($user['technical_skills'])

: "-";

?>

</td>

<th>Languages</th>

<td>

<?php

echo !empty($user['languages'])

? htmlspecialchars($user['languages'])

: "-";

?>

</td>

</tr>

<tr>

<th>Experience</th>

<td>

<?php

echo !empty($user['total_experience'])

? htmlspecialchars($user['total_experience'])

: "Fresher";

?>

</td>

<th>Current Company</th>

<td>

<?php

echo !empty($user['current_company'])

? htmlspecialchars($user['current_company'])

: "-";

?>

</td>

</tr>

            </tr>

                        <!-- Career Details -->

            <tr>

                <th>Career Choice</th>

                <td>

                    <?php
                    echo !empty($user['career_choice'])
                    ? htmlspecialchars($user['career_choice'])
                    : "-";
                    ?>

                </td>

                <th>Preferred Job Role</th>

                <td>

                    <?php
                    echo !empty($user['job_role'])
                    ? htmlspecialchars($user['job_role'])
                    : "-";
                    ?>

                </td>

            </tr>

            <tr>

                <th>Preferred Location</th>

                <td>

                    <?php
                    echo !empty($user['preferred_location'])
                    ? htmlspecialchars($user['preferred_location'])
                    : "-";
                    ?>

                </td>

                <th>Expected CTC</th>

                <td>

                    <?php
                    echo !empty($user['expected_ctc'])
                    ? htmlspecialchars($user['expected_ctc'])
                    : "-";
                    ?>

                </td>

            </tr>

            <!-- Address -->

            <tr>

                <th>Address</th>

                <td>

                    <?php
                    echo !empty($user['address'])
                    ? htmlspecialchars($user['address'])
                    : "-";
                    ?>

                </td>

                <th>City</th>

                <td>

                    <?php
                    echo !empty($user['city'])
                    ? htmlspecialchars($user['city'])
                    : "-";
                    ?>

                </td>

            </tr>

            <tr>

                <th>State</th>

                <td>

                    <?php
                    echo !empty($user['state'])
                    ? htmlspecialchars($user['state'])
                    : "-";
                    ?>

                </td>

                <th>Pincode</th>

                <td>

                    <?php
                    echo !empty($user['pincode'])
                    ? htmlspecialchars($user['pincode'])
                    : "-";
                    ?>

                </td>

            </tr>

            <!-- Identity -->

            <tr>

                <th>Aadhaar Number</th>

                <td>

                    <?php
                    echo !empty($user['aadhaar'])
                    ? htmlspecialchars($user['aadhaar'])
                    : "-";
                    ?>

                </td>

                <th>PAN Number</th>

                <td>

                    <?php
                    echo !empty($user['pan'])
                    ? htmlspecialchars($user['pan'])
                    : "-";
                    ?>

                </td>

            </tr>

           <!-- Online Profiles -->

<tr>

    <th>LinkedIn</th>

    <td>

        <?php if(!empty($user['linkedin'])){ ?>

            <a href="<?php echo htmlspecialchars($user['linkedin']); ?>"
               target="_blank"
               class="profile-btn linkedin-btn">

                <i class="fa-brands fa-linkedin"></i> LinkedIn

            </a>

        <?php } else { ?>

            -

        <?php } ?>

    </td>

    <th>GitHub</th>

    <td>

        <?php if(!empty($user['github'])){ ?>

            <a href="<?php echo htmlspecialchars($user['github']); ?>"
               target="_blank"
               class="profile-btn github-btn">

                <i class="fa-brands fa-github"></i> GitHub

            </a>

        <?php } else { ?>

            -

        <?php } ?>

    </td>

</tr>

<tr>

    <th>Instagram</th>

    <td>

        <?php if(!empty($user['instagram'])){ ?>

            <a href="<?php echo htmlspecialchars($user['instagram']); ?>"
               target="_blank"
               class="profile-btn insta-btn">

                <i class="fa-brands fa-instagram"></i> Instagram

            </a>

        <?php } else { ?>

            -

        <?php } ?>

    </td>

    <th>Portfolio</th>

    <td>

        <?php if(!empty($user['portfolio'])){ ?>

            <a href="<?php echo htmlspecialchars($user['portfolio']); ?>"
               target="_blank"
               class="profile-btn portfolio-btn">

                <i class="fa-solid fa-globe"></i> Portfolio

            </a>

        <?php } else { ?>

            -

        <?php } ?>

    </td>

</tr>

<tr>

    <th>Resume</th>

    <td colspan="3">

        <?php if(!empty($user['resume'])){ ?>

            <a href="../assets/uploads/resume/<?php echo htmlspecialchars($user['resume']); ?>"
               target="_blank"
               class="resume-btn">

                <i class="fa-solid fa-file-pdf"></i> View Resume

            </a>

        <?php } else { ?>

            Resume Not Uploaded

        <?php } ?>

    </td>

</tr>
        </table>

    </div>

</section>

<!-- ==========================================
     QUICK ACTIONS
========================================== -->

<section class="quick-actions-section">

    <div class="section-title">

        <i class="fa-solid fa-bolt"></i>

        <h2>Quick Actions</h2>

    </div>

    <div class="quick-actions-grid">

        <a href="../profile/profile.php" class="action-card">

            <i class="fa-solid fa-user"></i>

            <h3>My Profile</h3>

            <p>View and update your profile information.</p>

        </a>

        <a href="../education/education.php" class="action-card">

            <i class="fa-solid fa-graduation-cap"></i>

            <h3>Education</h3>

            <p>Manage academic qualifications.</p>

        </a>

        <a href="../professional/professional-profile.php" class="action-card">

            <i class="fa-solid fa-user-tie"></i>

            <h3>Professional</h3>

            <p>Update your professional profile.</p>

        </a>

        <a href="../jobs/job-preference.php" class="action-card">

            <i class="fa-solid fa-briefcase"></i>

            <h3>Job Preference</h3>

            <p>Update preferred job details.</p>

        </a>

        <a href="../mock-exams/index.php" class="action-card">

            <i class="fa-solid fa-book-open"></i>

            <h3>Mock Exams</h3>

            <p>Practice with online assessments.</p>

        </a>

        <a href="../jobs/available-jobs.php" class="action-card">

            <i class="fa-solid fa-building"></i>

            <h3>Available Jobs</h3>

            <p>Browse the latest openings.</p>

        </a>

        <a href="../jobs/applications.php" class="action-card">

            <i class="fa-solid fa-file-lines"></i>

            <h3>Applications</h3>

            <p>Track all submitted applications.</p>

        </a>

        <a href="../upload-resume/upload-resume.php" class="action-card">

            <i class="fa-solid fa-file-arrow-up"></i>

            <h3>Resume </h3>

            <p>Create and update your resume.</p>

        </a>

        <a href="../resume/templates.php" class="action-card">

            <i class="fa-solid fa-print"></i>

            <h3>Print Resume</h3>

            <p>Print your resume in various formats.</p>
        

        </a>


        <a href="../notifications/notifications.php"
           class="action-card">

            <i class="fa-solid fa-bell"></i>

            <h3>Notifications</h3>

            <p>Check interview alerts and updates.</p>

        </a>

        <a href="../settings/settings.php"
           class="action-card">

            <i class="fa-solid fa-gear"></i>

            <h3>Settings</h3>

            <p>Manage account settings.</p>

        </a>

    </div>

</section>

<!-- ==========================================
     FOOTER
========================================== -->

<footer class="dashboard-footer">

    <div class="footer-left">

        <h3>

            CareerForge Candidate Portal

        </h3>

        <p>

            Empowering candidates through learning,
            mock exams, resume building,
            and career opportunities.

        </p>

    </div>

    <div class="footer-center">

        <h4>

            Quick Links

        </h4>

        <ul>

            <li>

                <a href="../profile/profile.php">

                    My Profile

                </a>

            </li>

            <li>

                <a href="../education/education.php">

                    Education

                </a>

            </li>

            <li>

                <a href="../mock-exams/index.php">

                    Mock Exams

                </a>

            </li>

            <li>

                <a href="../jobs/available-jobs.php">

                    Jobs

                </a>

            </li>

        </ul>

    </div>

    <div class="footer-right">

        <h4>

            Contact

        </h4>

        <p>

            <i class="fa-solid fa-envelope"></i>

            support@careerforge.in

        </p>

        <p>

            <i class="fa-solid fa-phone"></i>

            +91 98765 43210

        </p>

        <p>

            <i class="fa-solid fa-location-dot"></i>

            Hyderabad, Telangana

        </p>

    </div>

</footer>

</main>

<!-- Dashboard JavaScript -->
<script src="../assets/js/dashboard.js"></script>

</body>
</html>