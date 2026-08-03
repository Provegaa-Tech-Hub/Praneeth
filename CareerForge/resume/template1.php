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

    "SELECT * FROM users
     WHERE id='$userId'"

);

if(mysqli_num_rows($userQuery) == 0){

    die("Candidate not found.");

}

$user = mysqli_fetch_assoc($userQuery);

/* ==========================================
MOCK SCORECARD
========================================== */

$scoreQuery = mysqli_query(

    $conn,

    "SELECT
        COUNT(*) AS total_exams,
        MAX(percentage) AS highest_score,
        AVG(percentage) AS average_score,
        MAX(submitted_date) AS last_exam
     FROM exam_results
     WHERE user_id='$userId'"

);

$score = mysqli_fetch_assoc($scoreQuery);


/* Latest Exam */

$latestQuery = mysqli_query(

    $conn,

    "SELECT percentage,status
     FROM exam_results
     WHERE user_id='$userId'
     ORDER BY submitted_date DESC
     LIMIT 1"

);

$latest = mysqli_fetch_assoc($latestQuery);

$overall = round($score['average_score'] ?? 0);

$totalExams = $score['total_exams'] ?? 0;

$highest = $score['highest_score'] ?? 0;

$status = $latest['status'] ?? "Not Attempted";


/* Rating */

if($overall >= 90){

    $rating = "Outstanding";

}
elseif($overall >= 75){

    $rating = "Excellent";

}
elseif($overall >= 60){

    $rating = "Good";

}
elseif($overall >= 40){

    $rating = "Average";

}
else{

    $rating = "Needs Improvement";

}

/* ==========================================
GET EDUCATION
========================================== */

$educationQuery = mysqli_query(

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

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Professional Resume | CareerForge

</title>

<link
rel="stylesheet"
href="../assets/css/template1.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="resume-container">

<!-- ==========================================
HEADER
========================================== -->

<div class="resume-header">

    <!-- Profile Photo -->

    <div class="profile-photo">

        <img
        src="../assets/images/profile/<?php
        echo !empty($user['profile_photo'])
        ? htmlspecialchars($user['profile_photo'])
        : "default.png";
        ?>"
        alt="Profile">

    </div>


    <!-- Candidate Details -->

    <div class="profile-info">

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


    <!-- MOCK SCORECARD -->

    <div class="mock-score-card">

        <h3>

            <i class="fa-solid fa-award"></i>

            Mock Scorecard

        </h3>

        <div class="score-circle">

            <?php echo $overall; ?>%

        </div>

        <p>

            <strong>Rating:</strong>

            <?php echo $rating; ?>

        </p>

        <p>

            <strong>Exams:</strong>

            <?php echo $totalExams; ?>

        </p>

        <p>

            <strong>Highest:</strong>

            <?php echo $highest; ?>%

        </p>

        <p>

            <strong>Status:</strong>

            <?php echo $status; ?>

        </p>

    </div>



</div>


<!-- ==========================================
CAREER OBJECTIVE
========================================== -->

<div class="resume-section">

    <h2>Career Objective</h2>

    <p>

        <?php

        echo !empty($user['career_objective'])

        ? nl2br(htmlspecialchars($user['career_objective']))

        : "Career objective not added.";

        ?>

    </p>

</div>

<!-- ==========================================
PERSONAL INFORMATION
========================================== -->

<div class="resume-section">

    <h2>Personal Information</h2>

    <table class="info-table">

        <tr>
            <td><strong>Date of Birth</strong></td>
            <td><?php echo !empty($user['dob']) ? date("d M Y", strtotime($user['dob'])) : "-"; ?></td>
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
            <td><strong>Blood Group</strong></td>
            <td><?php echo htmlspecialchars($user['blood_group']); ?></td>
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

        <tr>
            <td><strong>LinkedIn</strong></td>
            <td><?php echo htmlspecialchars($user['linkedin']); ?></td>
        </tr>

        <tr>
            <td><strong>GitHub</strong></td>
            <td><?php echo htmlspecialchars($user['github']); ?></td>
        </tr>

        <tr>
            <td><strong>Portfolio</strong></td>
            <td><?php echo htmlspecialchars($user['portfolio']); ?></td>
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
TECHNICAL SKILLS
========================================== -->

<div class="resume-section">

    <h2>Technical Skills</h2>

    <table class="info-table">

        <tr>

            <td width="220">

                <strong>Primary Skills</strong>

            </td>

            <td>

                <?php

                echo !empty($user['primary_skills'])

                ? nl2br(htmlspecialchars($user['primary_skills']))

                : "-";

                ?>

            </td>

        </tr>

        <tr>

            <td>

                <strong>Secondary Skills</strong>

            </td>

            <td>

                <?php

                echo !empty($user['secondary_skills'])

                ? nl2br(htmlspecialchars($user['secondary_skills']))

                : "-";

                ?>

            </td>

        </tr>

        <tr>

            <td>

                <strong>Technical Skills</strong>

            </td>

            <td>

                <?php

                echo !empty($user['technical_skills'])

                ? nl2br(htmlspecialchars($user['technical_skills']))

                : "-";

                ?>

            </td>

        </tr>

    </table>

</div>

<!-- ==========================================
SOFT SKILLS
========================================== -->

<div class="resume-section">

    <h2>Soft Skills</h2>

    <p>

        <?php

        echo !empty($user['soft_skills'])

        ? nl2br(htmlspecialchars($user['soft_skills']))

        : "No soft skills added.";

        ?>

    </p>

</div>

<!-- ==========================================
CERTIFICATIONS
========================================== -->

<div class="resume-section">

    <h2>Certifications</h2>

    <p>

        <?php

        echo !empty($user['certifications'])

        ? nl2br(htmlspecialchars($user['certifications']))

        : "No certifications available.";

        ?>

    </p>

</div>

<!-- ==========================================
LANGUAGES
========================================== -->

<div class="resume-section">

    <h2>Languages Known</h2>

    <p>

        <?php

        echo !empty($user['languages'])

        ? htmlspecialchars($user['languages'])

        : "Not specified.";

        ?>

    </p>

</div>

<!-- ==========================================
PROJECTS
========================================== -->

<div class="resume-section">

    <h2>Projects</h2>

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

    <h2>Internship</h2>

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

    <h2>Work Experience</h2>

    <?php

    if(!empty($user['current_company'])){

    ?>

    <table class="info-table">

        <tr>

            <td width="220">

                <strong>Current Company</strong>

            </td>

            <td>

                <?php echo htmlspecialchars($user['current_company']); ?>

            </td>

        </tr>

        <tr>

            <td>

                <strong>Designation</strong>

            </td>

            <td>

                <?php echo htmlspecialchars($user['designation']); ?>

            </td>

        </tr>

        <tr>

            <td>

                <strong>Total Experience</strong>

            </td>

            <td>

                <?php echo htmlspecialchars($user['total_experience']); ?>

            </td>

        </tr>

        <tr>

            <td>

                <strong>Relevant Experience</strong>

            </td>

            <td>

                <?php echo htmlspecialchars($user['relevant_experience']); ?>

            </td>

        </tr>

        <tr>

            <td>

                <strong>Current CTC</strong>

            </td>

            <td>

                <?php echo htmlspecialchars($user['current_ctc']); ?>

            </td>

        </tr>

        <tr>

            <td>

                <strong>Notice Period</strong>

            </td>

            <td>

                <?php echo htmlspecialchars($user['notice_period']); ?>

            </td>

        </tr>

        <tr>

            <td>

                <strong>Current Location</strong>

            </td>

            <td>

                <?php echo htmlspecialchars($user['current_location']); ?>

            </td>

        </tr>

    </table>

    <?php

    }else{

        echo "<p>Fresher - No work experience available.</p>";

    }

    ?>

</div>

<!-- ==========================================
PREVIOUS COMPANIES
========================================== -->

<div class="resume-section">

    <h2>Previous Companies</h2>

    <p>

        <?php

        echo !empty($user['previous_companies'])

        ? nl2br(htmlspecialchars($user['previous_companies']))

        : "Not Available";

        ?>

    </p>

</div>

<!-- ==========================================
RESPONSIBILITIES
========================================== -->

<div class="resume-section">

    <h2>Key Responsibilities</h2>

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

    <h2>Achievements</h2>

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

    <h2>Job Preferences</h2>

    <table class="info-table">

        <tr>

            <td width="220"><strong>Preferred Job Role</strong></td>

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

            <td><strong>Preferred Location 1</strong></td>

            <td><?php echo htmlspecialchars($user['preferred_location']); ?></td>

        </tr>

        <tr>

            <td><strong>Preferred Location 2</strong></td>

            <td><?php echo htmlspecialchars($user['preferred_location2']); ?></td>

        </tr>

        <tr>

            <td><strong>Preferred Location 3</strong></td>

            <td><?php echo htmlspecialchars($user['preferred_location3']); ?></td>

        </tr>

        <tr>

            <td><strong>Expected CTC</strong></td>

            <td><?php echo htmlspecialchars($user['expected_ctc']); ?></td>

        </tr>

        <tr>

            <td><strong>Joining Date</strong></td>

            <td>

                <?php

                echo !empty($user['joining_date'])

                ? date("d M Y", strtotime($user['joining_date']))

                : "-";

                ?>

            </td>

        </tr>

    </table>

</div>

<!-- ==========================================
DECLARATION
========================================== -->

<div class="resume-section">

    <h2>Declaration</h2>

    <p>

        I hereby declare that all the information provided in this resume is true and correct to the best of my knowledge and belief.

    </p>

</div>

<!-- ==========================================
SIGNATURE
========================================== -->

<div class="signature-section">

    <div class="signature-box">

        <p><strong><?php echo htmlspecialchars($user['full_name']); ?></strong></p>

        <span>Candidate Signature</span>

    </div>

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

        Back to Templates

    </a>

    <a
    href="../dashboard/dashboard.php"
    class="dashboard-btn">

        <i class="fa-solid fa-house"></i>

        Dashboard

    </a>

</div>

<!-- ==========================================
FOOTER
========================================== -->

<footer class="resume-footer">

    <p>

        Resume generated by <strong>CareerForge Recruitment Portal</strong>

    </p>

    <p>

        Generated on <?php echo date("d M Y"); ?>

    </p>

</footer>

</div>

</body>

</html>